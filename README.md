## Instagram Gallery for TastyIgniter

Quick Api integration to get an Instagram Gallery in your TI pages. 

### How it works

Instagram provides a 'Basic Display API' which can be authenticated through Oauth2. We don't need to use Oauth for this plugin as all we're doing is to read gallery data, and we can use Instagram's long-lived Token Generator instead. 

You'll provide the plugin with long-lived API token for each Insagram account that you'll be drawing from. The plugin will gather media urls for each instagram feed every set number of minutes and save them into the TI db. Media itself will always be hosted by Instagram. Long-lived tokens last for 60 days, and will be refreshed after a set number of days. 

### Getting a long-lived Instagram API token

You need to have both a Facebook account in developer mode and a public Instagram Account. Go to https://developers.facebook.com/ to sign up for a developer account if don't already have one. We're going to create a Facebook app that is assigned as an Instagram Tester, which contrary to what the name may imply, is capable of generating long-lived access tokens and may be used in the production mode of your app. We're relying on this spot of documentation found at https://developers.facebook.com/docs/instagram-basic-display-api/overview :

```
If you are creating an app solely for the purpose of generating access tokens with the User Token Generator, you do not need to submit your app for App Review. The User Token Generator does not require any permissions and can be used while your app is in Development Mode.
```

From your Facebook Developer Account at https://developers.facebook.com/apps/, select 'Create a new App' and select Type: Consumer. Fill in your app details as requested.

Once Created, go to Settings => Basic and click 'Add Platform' and select the type 'Website'. Enter in the URL of the website that you'll be displaying your instagram feed on. You'll need a Data policy URL at this time as well, which should point to whatever you've got set up as a terms of service agreement for your website.

Return to your App Dashboard and select "Add Products to Your App" => "Instagram Basic Display Feed". You should now have a Menu under "Instagram Basic Display" => "Basic Display". Note that this page will try to get you to add permissions and submit your application for review, but for our purposes we do not need to do this (appliations need to be reviewed if they're to be given permissions that involve editing instagram data, which we won't be doing).

Under "User Token Generator" click on "Add or Remove Instagram Testers". Add an "Instagram Tester" with the username of the *Instagram* account that you want to draw images from. Note that you aren't adding a "Tester", which also appears on this page. You'll see your Instagram Tester account in the status "(pending)". 

You'll now need to log into your Insagram account, which is done most easily through a new browser window at instagram.com. Once logged in, go to your account profile (icon on the top right) and click the gear icon to edit your profile. In the profile editing window, select "Apps and Websites" and then the "Tester Invites" Tab. You should see your Instagram Tester invite, which you'll need to hit "Accept" on.  

Now, back in your Facebook App settings under "Roles"=>"Roles" click on "Add Instagram Testers" and add the same account. 

"User Token Generator", you should see your test user with a button "Generate Token". Click the button now and it'll ask you to log into your instagram account yet again, and click "Allow" on the permissions that it's asking to grant. You'll then get a long-lived access token! Save this somewhere safe, or put it directly into your TastyIgniter admin under Display => Instagram Users



