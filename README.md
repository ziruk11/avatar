# Avatar
An easy and good-looking website for creating and customizing avatars and a simple telegram bot to use them to create custom stickers. 

Try the website at [getavatars](https://telegramchatbot.altervista.org/getavatar.php) and the telegram bot at [Avatar bot](https://t.me/getavatar_bot)

![preview](/avatar/copertina.png)






## How to set up
Copy all the content of this repository in your folder and change the value of some constants how shown below:

```YOUR_BOT_TOKEN``` with your bot token from botfather

```YOUR_BOT_NAME``` with the name of your bot (i.e. getavatar_bot)

```YOUR_SITE``` with the link of your site (i.e. telegramchatbot.altervista.org/getavatar.php)

```YOUR_PATH``` with the path of your folder (i.e. telegramchatbot.altervista.org/)

You'll need to set the webhook of your bot to getavatarbot.php. You can use the link below
```api.telegram.org/botYOUR_BOT_TOKEN/setWebhook?url=YOUR_PATH/getavatarbot.php```

### NOTE
* Made with php 7.3
* getavatar.php is basically your index file
* getavataar.php is the mobile optimized version of getavatar.php
* Done using the [openpeeps](https://www.openpeeps.com/) library.
