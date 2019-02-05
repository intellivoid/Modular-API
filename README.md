# Modular API

This PHP Library is a Modular API Library, allowing you to create
Modular-Type HTTP APIs, This system also manages API Keys, Includes
usage analytics, request limitations, module manager.

-------------------------------------------------------------------

This Library Requires MariaDB/MySQL and PHP 7+

-------------------------------------------------------------------

## Description

Modular API is a simple Modular API System with Access Key Management,
This library allows you to build APIs with a constructed JSON configuration
file, while letting the Modular API HTTP Handler auto-load the API Modules
you create.

Authentication and auto-loading is handled by the HTTP Handler, 

-------------------------------------------------------------------

## Configuration Template

This is a example of the Modular API Configuration for a HTTP Server

```json
{
    "v1": {
      "API": {
        "AVAILABLE": true,
        "UNAVAILABLE_MESSAGE": "The API is unavailable at the moment"
      },
      "POLICY": {
        "AUTHENTICATION_REQUIRED": false,
        "FORCE_CERTIFICATE": false
      },
      "MODULES":
      {
        "GetTime": {
          "REQUIRE_AUTHENTICATION": false,
          "REQUIRE_USAGE": false,
          "POST_METHOD_ALLOWED": true,
          "GET_METHOD_ALLOWED": true,
          "SCRIPT": "get_time",
          "PARAMETERS":
          {
            "timezone": {"REQUIRED": false, "DEFAULT": "example123"}
          }
        }
      }
    }
}
```


### ROOT Document (v...)

This defines the version of the API, which is accessed with the url scheme `/v1`

```json
{
  "v1": { ... }
}
```


### API

This contains general configuration for the API Version.

```json
{
  "AVAILABLE": false,
  "UNAVAILABLE_MESSAGE": "The API is unavailable at the moment"
}
```

`AVAILABLE` (bool) = *Indicates if this API Version is available*

`UNAVAILABLE_MESSAGE` (string) = *The message that gets displayed if `AVAILABLE` is set to `false`*


### POLICY

General policies for this API Version, setting some configurations
will override the configuration for other objects

```json
{
  "AUTHENTICATION_REQUIRED": false,
  "FORCE_CERTIFICATE": false
}
```

`AUTHENTICATION_REQUIRED` (bool) = *Everything related to this API requires authentication if set to `True`*

`FORCE_CERTIFICATE` (bool) = *If set to `True`, authentication requires a certificate. And will not accept `api_key` as a form of authentication*


### MODULES

This is list of `MODULE` objects wich defines which Modules are available on
the version of the API, and what their individual configurations are.


-------------------------------------------------------------------


### Module Object

A Module object contains the necessary configuration for how the Module is
applied to the API.

```json
{
  "MODULE_NAME": {
    "REQUIRE_AUTHENTICATION": false,
    "REQUIRE_USAGE": false,
    "POST_METHOD_ALLOWED": true,
    "GET_METHOD_ALLOWED": true,
    "SCRIPT": "get_time",
    "PARAMETERS":
    {
      "timezone": {"REQUIRED": false, "DEFAULT": "example123"}
    }
  }
}

```

The Module Name is simply a definition for how the module is accessed by
the URL Scheme, in the example shown above the URL Scheme would be `/v1/getTime`
The module name is not case-sensitive for the URL.


`REQUIRE_AUTHENTICATION` (bool) = *Indicates if this Module requires authentication, this is ignored if the policy of the API requires authentication throughout the whole API*

`REQUIRE_USAGE` (bool) = *This indicates if the user needs to have the available usage resources to use this module, if set to true. The user may be blocked from using the module if resources has exceeded. However, this is ignored if there was no authentication*

`POST_METHOD_ALLOWED`/`GET_METHOD_ALLOED` (bool) = *Simple indication if these methods are allowed*

`SCRIPT` (bool) = *The name of the PHP Script that gets executed for this module, usually found in `/modules/<version>/` of the http server*,

`PARAMERTERS` (array (stdclass)) = *An array of Paramerter Objects, see Parameter Object for more information*


-------------------------------------------------------------------


### Paramerter Object

This object is usually defined within the Module's object Parameters Property.
which simply defines what parameters the module requires. The Module script will
only be capable of seeing parameters that are defined, other parameters are simply
ignored for security reasons. These parameters are fetched from `GET` or `POST` values.
The HTTP Handler will throw an error if a required paramerter is missing.

```json
{
  "PARAMERTER_NAME": {"REQUIRED": false, "DEFAULT": "example123"}
}
```

The Key of the object is defined by the name of the Paramerter, if the
name is `secret` for the module `folder`, the paramerter can be used as so;
`/v1/folder?secret=123`, the same expected usage is the same if the user is allowed
to make a `POST` request as well.


`REQUIRED` (bool) = *Indicates if this paramerter is required, throws an error if the paramerter is missing*

`DEFAULT` (string) = *If the paramerter isn't required, a default value can be placed optionally. Otherwise the paramerter will always return `null` unless defined*
