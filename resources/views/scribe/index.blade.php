<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
        href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
        body .content .bash-example code {
            display: none;
        }

        body .content .javascript-example code {
            display: none;
        }
    </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

    <a href="#" id="nav-button">
        <span>
            MENU
            <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
        </span>
    </a>
    <div class="tocify-wrapper">

        <div class="lang-selector">
            <button type="button" class="lang-button" data-language-name="bash">bash</button>
            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
        </div>

        <div class="search">
            <input type="text" class="search" id="input-search" placeholder="Search">
        </div>

        <div id="toc">
            <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
            </ul>
            <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
            </ul>
            <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-documentation">
                        <a href="#endpoints-GETapi-documentation">Handles the API request and renders the Swagger documentation view.</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-oauth2-callback">
                        <a href="#endpoints-GETapi-oauth2-callback">Handles the OAuth2 callback and retrieves the required file for the redirect.</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-createUser">
                        <a href="#endpoints-POSTapi-createUser">POST api/createUser</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-login">
                        <a href="#endpoints-POSTapi-login">POST api/login</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-getuser">
                        <a href="#endpoints-GETapi-getuser">GET api/getuser</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-PATCHapi-updateuser">
                        <a href="#endpoints-PATCHapi-updateuser">PATCH api/updateuser</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-PATCHapi-changepassword">
                        <a href="#endpoints-PATCHapi-changepassword">PATCH api/changepassword</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-getuserbyid--id-">
                        <a href="#endpoints-GETapi-getuserbyid--id-">GET api/getuserbyid/{id}</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-getallusers">
                        <a href="#endpoints-GETapi-getallusers">GET api/getallusers</a>
                    </li>
                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-createPermission">
                        <a href="#endpoints-POSTapi-createPermission">POST api/createPermission</a>
                    </li>
                </ul>
            </ul>
        </div>

        <ul class="toc-footer" id="toc-footer">
            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
        </ul>

        <ul class="toc-footer" id="last-updated">
            <li>Last updated: May 28, 2025</li>
        </ul>
    </div>

    <div class="page-wrapper">
        <div class="dark-box"></div>
        <div class="content">
            <h1 id="introduction">Introduction</h1>
            <aside>
                <strong>Base URL</strong>: <code>http://localhost</code>
            </aside>
            <pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

            <h1 id="authenticating-requests">Authenticating requests</h1>
            <p>This API is not authenticated.</p>

            <h1 id="endpoints">Endpoints</h1>



            <h2 id="endpoints-GETapi-documentation">Handles the API request and renders the Swagger documentation view.</h2>

            <p>
            </p>



            <span id="example-requests-GETapi-documentation">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/documentation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/documentation"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-documentation">
                <blockquote>
                    <p>Example response (500):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-documentation" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-GETapi-documentation"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-documentation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-documentation" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-documentation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-GETapi-documentation" data-method="GET"
                data-path="api/documentation"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-documentation', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-documentation"
                        onclick="tryItOut('GETapi-documentation');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-documentation"
                        onclick="cancelTryOut('GETapi-documentation');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-documentation"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/documentation</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="GETapi-documentation"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="GETapi-documentation"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="endpoints-GETapi-oauth2-callback">Handles the OAuth2 callback and retrieves the required file for the redirect.</h2>

            <p>
            </p>



            <span id="example-requests-GETapi-oauth2-callback">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/oauth2-callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/oauth2-callback"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-oauth2-callback">
                <blockquote>
                    <p>Example response (200):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
                    </summary>
                    <pre><code class="language-http">content-type: text/html; charset=UTF-8
cache-control: no-cache, private
access-control-allow-origin: *
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">&lt;!doctype html&gt;
&lt;html lang=&quot;en-US&quot;&gt;
&lt;head&gt;
    &lt;title&gt;Swagger UI: OAuth2 Redirect&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;script&gt;
    &#039;use strict&#039;;
    function run () {
        var oauth2 = window.opener.swaggerUIRedirectOauth2;
        var sentState = oauth2.state;
        var redirectUrl = oauth2.redirectUrl;
        var isValid, qp, arr;

        if (/code|token|error/.test(window.location.hash)) {
            qp = window.location.hash.substring(1).replace(&#039;?&#039;, &#039;&amp;&#039;);
        } else {
            qp = location.search.substring(1);
        }

        arr = qp.split(&quot;&amp;&quot;);
        arr.forEach(function (v,i,_arr) { _arr[i] = &#039;&quot;&#039; + v.replace(&#039;=&#039;, &#039;&quot;:&quot;&#039;) + &#039;&quot;&#039;;});
        qp = qp ? JSON.parse(&#039;{&#039; + arr.join() + &#039;}&#039;,
                function (key, value) {
                    return key === &quot;&quot; ? value : decodeURIComponent(value);
                }
        ) : {};

        isValid = qp.state === sentState;

        if ((
          oauth2.auth.schema.get(&quot;flow&quot;) === &quot;accessCode&quot; ||
          oauth2.auth.schema.get(&quot;flow&quot;) === &quot;authorizationCode&quot; ||
          oauth2.auth.schema.get(&quot;flow&quot;) === &quot;authorization_code&quot;
        ) &amp;&amp; !oauth2.auth.code) {
            if (!isValid) {
                oauth2.errCb({
                    authId: oauth2.auth.name,
                    source: &quot;auth&quot;,
                    level: &quot;warning&quot;,
                    message: &quot;Authorization may be unsafe, passed state was changed in server. The passed state wasn&#039;t returned from auth server.&quot;
                });
            }

            if (qp.code) {
                delete oauth2.state;
                oauth2.auth.code = qp.code;
                oauth2.callback({auth: oauth2.auth, redirectUrl: redirectUrl});
            } else {
                let oauthErrorMsg;
                if (qp.error) {
                    oauthErrorMsg = &quot;[&quot;+qp.error+&quot;]: &quot; +
                        (qp.error_description ? qp.error_description+ &quot;. &quot; : &quot;no accessCode received from the server. &quot;) +
                        (qp.error_uri ? &quot;More info: &quot;+qp.error_uri : &quot;&quot;);
                }

                oauth2.errCb({
                    authId: oauth2.auth.name,
                    source: &quot;auth&quot;,
                    level: &quot;error&quot;,
                    message: oauthErrorMsg || &quot;[Authorization failed]: no accessCode received from the server.&quot;
                });
            }
        } else {
            oauth2.callback({auth: oauth2.auth, token: qp, isValid: isValid, redirectUrl: redirectUrl});
        }
        window.close();
    }

    if (document.readyState !== &#039;loading&#039;) {
        run();
    } else {
        document.addEventListener(&#039;DOMContentLoaded&#039;, function () {
            run();
        });
    }
&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-oauth2-callback" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-GETapi-oauth2-callback"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-oauth2-callback"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-oauth2-callback" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-oauth2-callback">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-GETapi-oauth2-callback" data-method="GET"
                data-path="api/oauth2-callback"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-oauth2-callback', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-oauth2-callback"
                        onclick="tryItOut('GETapi-oauth2-callback');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-oauth2-callback"
                        onclick="cancelTryOut('GETapi-oauth2-callback');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-oauth2-callback"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/oauth2-callback</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="GETapi-oauth2-callback"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="GETapi-oauth2-callback"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="endpoints-POSTapi-createUser">POST api/createUser</h2>

            <p>
            </p>



            <span id="example-requests-POSTapi-createUser">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/createUser" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"b\",
    \"password\": \"]|{+-0pBNvYg\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/createUser"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "b",
    "password": "]|{+-0pBNvYg"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-createUser">
            </span>
            <span id="execution-results-POSTapi-createUser" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-POSTapi-createUser"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-createUser"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-createUser" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-createUser">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-POSTapi-createUser" data-method="POST"
                data-path="api/createUser"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-createUser', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-createUser"
                        onclick="tryItOut('POSTapi-createUser');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-createUser"
                        onclick="cancelTryOut('POSTapi-createUser');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-createUser"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/createUser</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="POSTapi-createUser"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="POSTapi-createUser"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="username" data-endpoint="POSTapi-createUser"
                        value="b"
                        data-component="body">
                    <br>
                    <p>Must not be greater than 255 characters. Example: <code>b</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="password" data-endpoint="POSTapi-createUser"
                        value="]|{+-0pBNvYg"
                        data-component="body">
                    <br>
                    <p>Must be at least 8 characters. Example: <code>]|{+-0pBNvYg</code></p>
                </div>
            </form>

            <h2 id="endpoints-POSTapi-login">POST api/login</h2>

            <p>
            </p>



            <span id="example-requests-POSTapi-login">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-login">
            </span>
            <span id="execution-results-POSTapi-login" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-POSTapi-login"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-login" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-POSTapi-login" data-method="POST"
                data-path="api/login"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-login"
                        onclick="tryItOut('POSTapi-login');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-login"
                        onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-login"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/login</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="POSTapi-login"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="POSTapi-login"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="endpoints-GETapi-getuser">GET api/getuser</h2>

            <p>
            </p>



            <span id="example-requests-GETapi-getuser">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/getuser" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/getuser"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-getuser">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    &quot;token_absent&quot;
]</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-getuser" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-GETapi-getuser"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-getuser"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-getuser" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-getuser">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-GETapi-getuser" data-method="GET"
                data-path="api/getuser"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-getuser', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-getuser"
                        onclick="tryItOut('GETapi-getuser');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-getuser"
                        onclick="cancelTryOut('GETapi-getuser');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-getuser"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/getuser</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="GETapi-getuser"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="GETapi-getuser"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="endpoints-PATCHapi-updateuser">PATCH api/updateuser</h2>

            <p>
            </p>



            <span id="example-requests-PATCHapi-updateuser">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/updateuser" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"fullName\": \"b\",
    \"phone_number\": \"ngzm\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/updateuser"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "fullName": "b",
    "phone_number": "ngzm"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-PATCHapi-updateuser">
            </span>
            <span id="execution-results-PATCHapi-updateuser" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-PATCHapi-updateuser"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PATCHapi-updateuser"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PATCHapi-updateuser" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PATCHapi-updateuser">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-PATCHapi-updateuser" data-method="PATCH"
                data-path="api/updateuser"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PATCHapi-updateuser', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PATCHapi-updateuser"
                        onclick="tryItOut('PATCHapi-updateuser');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PATCHapi-updateuser"
                        onclick="cancelTryOut('PATCHapi-updateuser');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PATCHapi-updateuser"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-purple">PATCH</small>
                    <b><code>api/updateuser</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="PATCHapi-updateuser"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="PATCHapi-updateuser"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>fullName</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none"
                        name="fullName" data-endpoint="PATCHapi-updateuser"
                        value="b"
                        data-component="body">
                    <br>
                    <p>Must not be greater than 100 characters. Example: <code>b</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none"
                        name="email" data-endpoint="PATCHapi-updateuser"
                        value=""
                        data-component="body">
                    <br>

                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    <i>optional</i> &nbsp;
                    <input type="text" style="display: none"
                        name="phone_number" data-endpoint="PATCHapi-updateuser"
                        value="ngzm"
                        data-component="body">
                    <br>
                    <p>Must not be greater than 12 characters. Example: <code>ngzm</code></p>
                </div>
            </form>

            <h2 id="endpoints-PATCHapi-changepassword">PATCH api/changepassword</h2>

            <p>
            </p>



            <span id="example-requests-PATCHapi-changepassword">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/changepassword" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"current_password\": \"architecto\",
    \"new_password\": \"ngzmiyvdljnikhwaykcmyuwpwl\"
}"
</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/changepassword"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "current_password": "architecto",
    "new_password": "ngzmiyvdljnikhwaykcmyuwpwl"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-PATCHapi-changepassword">
            </span>
            <span id="execution-results-PATCHapi-changepassword" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-PATCHapi-changepassword"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-PATCHapi-changepassword"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-PATCHapi-changepassword" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-PATCHapi-changepassword">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-PATCHapi-changepassword" data-method="PATCH"
                data-path="api/changepassword"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('PATCHapi-changepassword', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-PATCHapi-changepassword"
                        onclick="tryItOut('PATCHapi-changepassword');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-PATCHapi-changepassword"
                        onclick="cancelTryOut('PATCHapi-changepassword');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-PATCHapi-changepassword"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-purple">PATCH</small>
                    <b><code>api/changepassword</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="PATCHapi-changepassword"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="PATCHapi-changepassword"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>current_password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="current_password" data-endpoint="PATCHapi-changepassword"
                        value="architecto"
                        data-component="body">
                    <br>
                    <p>Example: <code>architecto</code></p>
                </div>
                <div style=" padding-left: 28px;  clear: unset;">
                    <b style="line-height: 2;"><code>new_password</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="new_password" data-endpoint="PATCHapi-changepassword"
                        value="ngzmiyvdljnikhwaykcmyuwpwl"
                        data-component="body">
                    <br>
                    <p>Must be at least 8 characters. Example: <code>ngzmiyvdljnikhwaykcmyuwpwl</code></p>
                </div>
            </form>

            <h2 id="endpoints-GETapi-getuserbyid--id-">GET api/getuserbyid/{id}</h2>

            <p>
            </p>



            <span id="example-requests-GETapi-getuserbyid--id-">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/getuserbyid/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/getuserbyid/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-getuserbyid--id-">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Token is absent or could not be parsed.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-getuserbyid--id-" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-GETapi-getuserbyid--id-"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-getuserbyid--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-getuserbyid--id-" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-getuserbyid--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-GETapi-getuserbyid--id-" data-method="GET"
                data-path="api/getuserbyid/{id}"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-getuserbyid--id-', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-getuserbyid--id-"
                        onclick="tryItOut('GETapi-getuserbyid--id-');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-getuserbyid--id-"
                        onclick="cancelTryOut('GETapi-getuserbyid--id-');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-getuserbyid--id-"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/getuserbyid/{id}</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="GETapi-getuserbyid--id-"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="GETapi-getuserbyid--id-"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
                    <small>string</small>&nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="id" data-endpoint="GETapi-getuserbyid--id-"
                        value="architecto"
                        data-component="url">
                    <br>
                    <p>The ID of the getuserbyid. Example: <code>architecto</code></p>
                </div>
            </form>

            <h2 id="endpoints-GETapi-getallusers">GET api/getallusers</h2>

            <p>
            </p>



            <span id="example-requests-GETapi-getallusers">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/getallusers" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/getallusers"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-GETapi-getallusers">
                <blockquote>
                    <p>Example response (401):</p>
                </blockquote>
                <details class="annotation">
                    <summary style="cursor: pointer;">
                        <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
                    </summary>
                    <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre>
                </details>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;error&quot;,
    &quot;message&quot;: &quot;Token is absent or could not be parsed.&quot;
}</code>
 </pre>
            </span>
            <span id="execution-results-GETapi-getallusers" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-GETapi-getallusers"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-GETapi-getallusers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-GETapi-getallusers" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-GETapi-getallusers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-GETapi-getallusers" data-method="GET"
                data-path="api/getallusers"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('GETapi-getallusers', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-GETapi-getallusers"
                        onclick="tryItOut('GETapi-getallusers');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-GETapi-getallusers"
                        onclick="cancelTryOut('GETapi-getallusers');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-GETapi-getallusers"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-green">GET</small>
                    <b><code>api/getallusers</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="GETapi-getallusers"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="GETapi-getallusers"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>

            <h2 id="endpoints-POSTapi-createPermission">POST api/createPermission</h2>

            <p>
            </p>



            <span id="example-requests-POSTapi-createPermission">
                <blockquote>Example request:</blockquote>


                <div class="bash-example">
                    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/createPermission" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre>
                </div>


                <div class="javascript-example">
                    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/createPermission"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
                </div>

            </span>

            <span id="example-responses-POSTapi-createPermission">
            </span>
            <span id="execution-results-POSTapi-createPermission" hidden>
                <blockquote>Received response<span
                        id="execution-response-status-POSTapi-createPermission"></span>:
                </blockquote>
                <pre class="json"><code id="execution-response-content-POSTapi-createPermission"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
            </span>
            <span id="execution-error-POSTapi-createPermission" hidden>
                <blockquote>Request failed with error:</blockquote>
                <pre><code id="execution-error-message-POSTapi-createPermission">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
            </span>
            <form id="form-POSTapi-createPermission" data-method="POST"
                data-path="api/createPermission"
                data-authed="0"
                data-hasfiles="0"
                data-isarraybody="0"
                autocomplete="off"
                onsubmit="event.preventDefault(); executeTryOut('POSTapi-createPermission', this);">
                <h3>
                    Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                        style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-tryout-POSTapi-createPermission"
                        onclick="tryItOut('POSTapi-createPermission');">Try it out ⚡
                    </button>
                    <button type="button"
                        style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-canceltryout-POSTapi-createPermission"
                        onclick="cancelTryOut('POSTapi-createPermission');" hidden>Cancel 🛑
                    </button>&nbsp;&nbsp;
                    <button type="submit"
                        style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                        id="btn-executetryout-POSTapi-createPermission"
                        data-initial-text="Send Request 💥"
                        data-loading-text="⏱ Sending..."
                        hidden>Send Request 💥
                    </button>
                </h3>
                <p>
                    <small class="badge badge-black">POST</small>
                    <b><code>api/createPermission</code></b>
                </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Content-Type" data-endpoint="POSTapi-createPermission"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
                <div style="padding-left: 28px; clear: unset;">
                    <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
                    &nbsp;
                    &nbsp;
                    <input type="text" style="display: none"
                        name="Accept" data-endpoint="POSTapi-createPermission"
                        value="application/json"
                        data-component="header">
                    <br>
                    <p>Example: <code>application/json</code></p>
                </div>
            </form>




        </div>
        <div class="dark-box">
            <div class="lang-selector">
                <button type="button" class="lang-button" data-language-name="bash">bash</button>
                <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
            </div>
        </div>
    </div>
</body>

</html>