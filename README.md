
# GLPI SAML SSO AUTHENTICATION

#### This is a GLPI plugin that facilitates single sign on authentication with an identity provider using the SAML 2.0 protocol.  This tool leverages the Onelogin PHP library.  Tested with ADFS 2.0+ and Google IDP

### Why SAML?

SAML is an XML-based standard for web browser single sign-on and is defined by the OASIS Security Services Technical Committee. The standard has been around since 2002, but lately it is becoming popular due its advantages:

* Usability - One-click access from portals or intranets, deep linking, password elimination and automatically renewing sessions make life easier for the user.
* Security - Based on strong digital signatures for authentication and integrity, SAML is a secure single sign-on protocol that the largest and most security conscious enterprises in the world rely on.
* Speed - SAML is fast. One browser redirect is all it takes to securely sign a user into an application.
* IT Friendly - SAML simplifies life for IT because it centralizes authentication, provides greater visibility and makes directory integration easier.
* Opportunity - B2B cloud vendor should support SAML to facilitate the integration of their product.

### Usage

Enter settings on the Plugin Page
![GLPI Settings Page](https://derrick-smith.com/wp-content/uploads/2020/10/Settings.png)

* SP Certificate = Your webserver certificate
* SP Certificate Key = Your webserver certificate key

#### Azure AD
1. Create a new enterprise application
2. Enable SAML Authentication
3. Configuration
* Entity ID = {Your GLPI web server base URL}
* Reply URL (Assertion Consumer Service URL) = {Your GLPI web server base URL}/plugins/phpsaml/front/acs.php

##### Name ID requirement
PHPSAML expects the NameID format to be "Email Address".  There is currently no way to change this dynamically in the plugin.  Sending an incorrect NameID claim will result in a SAML Response error.

For Azure AD, the following NameID configuration is correct.  You could also use user.mail as the Source Attribute.
![Azure AD NameID](https://derrick-smith.com/wp-content/uploads/2021/03/PHPSAML-nameid.png)

##### Where to find IdP settings required for GLPI?
![Azure AD Configuration](https://derrick-smith.com/wp-content/uploads/2020/10/Azure-Configuration.png)




