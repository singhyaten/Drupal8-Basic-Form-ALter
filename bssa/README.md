The 'Basic Site Settings Alter' module adds a new field (Site API Key) in the 'admin/config/system/site-information' page.

## Installation

### Manually

 * Simple installation process like other contrib modules
 
## Usage

 1. Add an event subscriber in your services file as added in this module.
 2. Override the router and set the Form that will override the core site information form.
 3. Custom submit handler to save the new field data in site information form.
 4. Custom url "page_json/%/%", arg(2) will check the siteapikey value of the site information and arg(3) will check the node id of the content type "page".
 5. if the siteapikey and arg(2) of the url is same and the arg(3) is a node of content type "page" then the node adta will appear on the screen in the form of Json else Acces Denied will appear.
 6. custom router is created in the routing.yml file open the custom url "page_json/%/%" and then further process.
 

