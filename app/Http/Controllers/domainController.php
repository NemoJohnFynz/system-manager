<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DomainModel;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\LogController;

class domainController extends Controller
{
    public function createDomain(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Please login to use this function'], 401);
        }

            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'createBy' => $user->username,
                'link' => 'required|string|max:255',
                'software_id' => 'required|integer|exists:software,id',
            ]);

            // Create a new domain record
            $domain = new DomainModel();
            $domain->name = $request->input('name');
            $domain->link = $request->input('link', '');
            $domain->software_id = $request->input('software_id',);
            $domain->description = $request->input('description');
            $domain->user_createby = $user->username;
            $domain->created_at = now();
            $domain->updated_at = now();

            // Save the domain record
            if ($domain->save()) {
                // Log the creation of the domain
                LogController::createLogAuto([
                    'username' => $user->username,
                    'domain_id' => $domain->id,
                    'message' => " user {$user->username} created domain '{$domain->domainName}'.",
                    'is_delete' => false
                ]);
                return response()->json(['message' => 'Domain created successfully', 'data' => $domain], 201);
            } else {
                return response()->json(['message' => 'Failed to create domain'], 500);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not create domain. ' . $e->getMessage()], 500);
        }
    }

    public function getAllDomains(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Please login to use this function'], 401);
            }

            // Retrieve all domains
            $domains = DomainModel::all();

            return response()->json(['message' => 'Domains retrieved successfully', 'data' => $domains], 200);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not retrieve domains. ' . $e->getMessage()], 500);
        }
    }

    public function updateDomain(Request $request)
{
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Please login to use this function'], 401);
        }

        // Validate the request data
        $request->validate([
            'id' => 'required|integer|exists:domains,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'link' => 'required|string|max:255',
        ]);

        // Find the domain record
        $domain = DomainModel::find($request->input('id'));
        if (!$domain) {
            return response()->json(['message' => 'Domain not found'], 404);
        }

        // Lưu thông tin cũ
        $oldData = $domain->only(['name', 'link', 'description']);

        // Update the domain record
        $domain->name = $request->input('name');
        $domain->link = $request->input('link', '');
        $domain->description = $request->input('description');
        $domain->updated_at = now();

        // Save the updated domain record
        if ($domain->save()) {
            // Lấy thông tin mới
            $newData = $domain->only(['name', 'link', 'description']);

            // So sánh và tạo chuỗi thay đổi
            $changes = [];
            foreach ($oldData as $key => $oldValue) {
                $newValue = $newData[$key];
                if ($oldValue != $newValue) {
                    $changes[] = "$key: '$oldValue' => '$newValue'";
                }
            }
            $changeString = $changes ? implode(', ', $changes) : 'No changes';

            // Log the update of the domain
            LogController::createLogAuto([
                'username' => $user->username,
                'domain_id' => $domain->id,
                'message' => "User {$user->username} updated domain '{$domain->name}'. Changes: $changeString",
                'is_delete' => false
            ]);
            return response()->json(['message' => 'Domain updated successfully', 'data' => $domain], 200);
        } else {
            return response()->json(['message' => 'Failed to update domain'], 500);
        }
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token has expired.'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is invalid.'], 401);
        } catch (JWTException $e) {
            return response()->json(['status' => 'error', 'message' => 'Token is absent or could not be parsed.'], 401);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Could not update domain. ' . $e->getMessage()], 500);   
        }
    }

}