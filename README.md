## Instagram Gallery for TastyIgniter

Quick Api integration to get an Instagram Gallery in your TI pages. 

### How it works

Instagram provides a 'Basic Display API' which can be authenticated through Oauth2. We don't need to use Oauth for this plugin as all we're doing is to read gallery data, and we can use Instagram's long-lived Token Generator instead. 

You'll provide the plugin with long-lived API token for each Insagram account that you'll be drawing from. The plugin will gather media urls for each instagram feed every set number of minutes and save them into the TI db. Media itself will always be hosted by Instagram. Long-lived tokens last for 60 days, and will be refreshed after a set number of days. 

### Getting a long-lived Instagram API token

You need to have both a Facebook account in developer mode and an Instagram Account. 