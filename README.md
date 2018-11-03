# Ziggeo PHP Server SDK 0.1.10

Ziggeo API (https://ziggeo.com) allows you to integrate video recording and playback with only
two lines of code in your site, service or app. This is the PHP Server SDK repository.

Pull requests welcome.


## Client-Side Integration

For the client-side integration, you need to add these assets to your html file:

```html 
<link rel="stylesheet" href="//assets-cdn.ziggeo.com/v2-stable/ziggeo.css" />
<script src="//assets-cdn.ziggeo.com/v2-stable/ziggeo.js"></script>
```

Then, you need to specify your api token:
```html 
<script>
    var ziggeoApplication = new ZiggeoApi.V2.Application({
        token: "APPLICATION_TOKEN"
    });
</script>
```

You can specify other global options, [see here](https://ziggeo.com/docs).

To fire up a recorder on your page, add:
```html 
<ziggeorecorder></ziggeorecorder>
``` 

To embed a player for an existing video, add:
```html 
<ziggeoplayer ziggeo-video='video-token'></ziggeoplayer>
``` 

For the full documentation, please visit [ziggeo.com](https://ziggeo.com/docs).

## Docker

If you prefer to run this SDK and its demos using [Docker](https://docker.com), build the image as follows:

```bash
docker build . -t ziggeo-php
```

You can then run demos as follows:
```bash
docker run --rm ziggeo-php /ziggeo/demos/list_all_videos.php --token xxx --privatekey xxx
```


## Webhooks

While you technically do not need this SDK to receive webhooks, we have included a demo for your convenience.

Run as follows:
```bash
php -S 0.0.0.0:12345 ./demos/webhook-printer.php
```

If you want to use docker, run as follows:
```bash
docker run --rm -p 12345:12345 ziggeo-php php -S 0.0.0.0:12345 /ziggeo/demos/webhook-printer.php
```

Your local machine needs to be accessible from the internet via port 12345. In most cases, you will be behind a router / NAT,
so you will either need to activate some sort of port forwarding or install a local port tunnel like [ngrok](https://ngrok.com).

Once such a tunnel is being installed, you can usually tunnel a particular port like 12345 as follows:
```bash
ngrok http 12345
```

The output will then provide you with a particular publicly accessible domain name that you can add to your Ziggeo webhook list:
```
http://543e13e6.ngrok.io -> localhost:12345
```

## Server-Side Integration

You can integrate the Server SDK as follows:

```php 
<?php require_once('./ziggeo/Ziggeo.php');
$ziggeo = new Ziggeo('*token*', '*private_key*', '*encryption_key*', *config*); ?> 
```


## Server-Side Methods

### Videos  

The videos resource allows you to access all single videos. Each video may contain more than one stream. 
 

#### Index 
 
Query an array of videos (will return at most 50 videos by default). Newest videos come first. 

```php 
$ziggeo->videos()->index($arguments = array()) 
``` 
 
Arguments 
- limit: *Limit the number of returned videos. Can be set up to 100.* 
- skip: *Skip the first [n] entries.* 
- reverse: *Reverse the order in which videos are returned.* 
- states: *Filter videos by state* 
- tags: *Filter the search result to certain tags, encoded as a comma-separated string* 


#### Count 
 
Get the video count for the application. 

```php 
$ziggeo->videos()->count($arguments = array()) 
``` 
 
Arguments 
- states: *Filter videos by state* 
- tags: *Filter the search result to certain tags, encoded as a comma-separated string* 


#### Get 
 
Get a single video by token or key. 

```php 
$ziggeo->videos()->get($token_or_key) 
``` 
 


#### Get Bulk 
 
Get multiple videos by tokens or keys. 

```php 
$ziggeo->videos()->get_bulk($arguments = array()) 
``` 
 
Arguments 
- tokens_or_keys: *Comma-separated list with the desired videos tokens or keys (Limit: 100 tokens or keys).* 


#### Stats Bulk 
 
Get stats for multiple videos by tokens or keys. 

```php 
$ziggeo->videos()->stats_bulk($arguments = array()) 
``` 
 
Arguments 
- tokens_or_keys: *Comma-separated list with the desired videos tokens or keys (Limit: 100 tokens or keys).* 
- summarize: *Boolean. Set it to TRUE to get the stats summarized. Set it to FALSE to get the stats for each video in a separate array. Default: TRUE.* 


#### Download Video 
 
Download the video data file 

```php 
$ziggeo->videos()->download_video($token_or_key) 
``` 
 


#### Download Image 
 
Download the image data file 

```php 
$ziggeo->videos()->download_image($token_or_key) 
``` 
 


#### Get Stats 
 
Get the video's stats 

```php 
$ziggeo->videos()->get_stats($token_or_key) 
``` 
 


#### Push To Service 
 
Push a video to a provided push service. 

```php 
$ziggeo->videos()->push_to_service($token_or_key, $arguments = array()) 
``` 
 
Arguments 
- pushservicetoken: *Push Services's token (from the Push Services configured for the app)* 


#### Apply Effect 
 
Apply an effect profile to a video. 

```php 
$ziggeo->videos()->apply_effect($token_or_key, $arguments = array()) 
``` 
 
Arguments 
- effectprofiletoken: *Effect Profile token (from the Effect Profiles configured for the app)* 


#### Apply Meta 
 
Apply a meta profile to a video. 

```php 
$ziggeo->videos()->apply_meta($token_or_key, $arguments = array()) 
``` 
 
Arguments 
- metaprofiletoken: *Meta Profile token (from the Meta Profiles configured for the app)* 


#### Update 
 
Update single video by token or key. 

```php 
$ziggeo->videos()->update($token_or_key, $arguments = array()) 
``` 
 
Arguments 
- min_duration: *Minimal duration of video* 
- max_duration: *Maximal duration of video* 
- tags: *Video Tags* 
- key: *Unique (optional) name of video* 
- volatile: *Automatically removed this video if it remains empty* 
- expiration_days: *After how many days will this video be deleted* 


#### Update Bulk 
 
Update multiple videos by token or key. 

```php 
$ziggeo->videos()->update_bulk($arguments = array()) 
``` 
 
Arguments 
- tokens_or_keys: *Comma-separated list with the desired videos tokens or keys (Limit: 100 tokens or keys).* 
- min_duration: *Minimal duration of video* 
- max_duration: *Maximal duration of video* 
- tags: *Video Tags* 
- volatile: *Automatically removed this video if it remains empty* 
- expiration_days: *After how many days will this video be deleted* 


#### Delete 
 
Delete a single video by token or key. 

```php 
$ziggeo->videos()->delete($token_or_key) 
``` 
 


#### Create 
 
Create a new video. 

```php 
$ziggeo->videos()->create($arguments = array()) 
``` 
 
Arguments 
- file: *Video file to be uploaded* 
- min_duration: *Minimal duration of video* 
- max_duration: *Maximal duration of video* 
- tags: *Video Tags* 
- key: *Unique (optional) name of video* 
- volatile: *Automatically removed this video if it remains empty* 


#### Analytics 
 
Get analytics for a specific videos with the given params 

```php 
$ziggeo->videos()->analytics($token_or_key, $arguments = array()) 
``` 
 
Arguments 
- from: *A UNIX timestamp in microseconds used as the start date of the query* 
- to: *A UNIX timestamp in microseconds used as the end date of the query* 
- date: *A UNIX timestamp in microseconds to retrieve data from a single date. If set, it overwrites the from and to params.* 
- query: *The query you want to run. It can be one of the following: device_views_by_os, device_views_by_date, total_plays_by_country, full_plays_by_country, total_plays_by_hour, full_plays_by_hour, total_plays_by_browser, full_plays_by_browser* 


### Streams  

The streams resource allows you to directly access all streams associated with a single video. 
 

#### Index 
 
Return all streams associated with a video 

```php 
$ziggeo->streams()->index($video_token_or_key, $arguments = array()) 
``` 
 
Arguments 
- states: *Filter streams by state* 


#### Get 
 
Get a single stream 

```php 
$ziggeo->streams()->get($video_token_or_key, $token_or_key) 
``` 
 


#### Download Video 
 
Download the video data associated with the stream 

```php 
$ziggeo->streams()->download_video($video_token_or_key, $token_or_key) 
``` 
 


#### Download Image 
 
Download the image data associated with the stream 

```php 
$ziggeo->streams()->download_image($video_token_or_key, $token_or_key) 
``` 
 


#### Push To Service 
 
Push a stream to a provided push service. 

```php 
$ziggeo->streams()->push_to_service($video_token_or_key, $token_or_key, $arguments = array()) 
``` 
 
Arguments 
- pushservicetoken: *Push Services's token (from the Push Services configured for the app)* 


#### Delete 
 
Delete the stream 

```php 
$ziggeo->streams()->delete($video_token_or_key, $token_or_key) 
``` 
 


#### Create 
 
Create a new stream 

```php 
$ziggeo->streams()->create($video_token_or_key, $arguments = array()) 
``` 
 
Arguments 
- file: *Video file to be uploaded* 


#### Attach Image 
 
Attaches an image to a new stream 

```php 
$ziggeo->streams()->attach_image($video_token_or_key, $token_or_key, $arguments = array()) 
``` 
 
Arguments 
- file: *Image file to be attached* 


#### Attach Video 
 
Attaches a video to a new stream 

```php 
$ziggeo->streams()->attach_video($video_token_or_key, $token_or_key, $arguments = array()) 
``` 
 
Arguments 
- file: *Video file to be attached* 


#### Bind 
 
Closes and submits the stream 

```php 
$ziggeo->streams()->bind($video_token_or_key, $token_or_key, $arguments = array()) 
``` 
 


### Authtokens  

The auth token resource allows you to manage authorization settings for video objects. 
 

#### Get 
 
Get a single auth token by token. 

```php 
$ziggeo->authtokens()->get($token) 
``` 
 


#### Update 
 
Update single auth token by token. 

```php 
$ziggeo->authtokens()->update($token_or_key, $arguments = array()) 
``` 
 
Arguments 
- volatile: *Will this object automatically be deleted if it remains empty?* 
- hidden: *If hidden, the token cannot be used directly.* 
- expiration_date: *Expiration date for the auth token* 
- usage_experitation_time: *Expiration time per session* 
- session_limit: *Maximal number of sessions* 
- grants: *Permissions this tokens grants* 


#### Delete 
 
Delete a single auth token by token. 

```php 
$ziggeo->authtokens()->delete($token_or_key) 
``` 
 


#### Create 
 
Create a new auth token. 

```php 
$ziggeo->authtokens()->create($arguments = array()) 
``` 
 
Arguments 
- volatile: *Will this object automatically be deleted if it remains empty?* 
- hidden: *If hidden, the token cannot be used directly.* 
- expiration_date: *Expiration date for the auth token* 
- usage_experitation_time: *Expiration time per session* 
- session_limit: *Maximal number of sessions* 
- grants: *Permissions this tokens grants* 


### Application  

The application token resource allows you to manage your application. 
 

#### Get 
 
Read application. 

```php 
$ziggeo->application()->get() 
``` 
 


#### Update 
 
Update application. 

```php 
$ziggeo->application()->update($arguments = array()) 
``` 
 
Arguments 
- volatile: *Will this object automatically be deleted if it remains empty?* 
- name: *Name of the application* 
- auth_token_required_for_create: *Require auth token for creating videos* 
- auth_token_required_for_update: *Require auth token for updating videos* 
- auth_token_required_for_read: *Require auth token for reading videos* 
- auth_token_required_for_destroy: *Require auth token for deleting videos* 
- client_can_index_videos: *Client is allowed to perform the index operation* 
- client_cannot_access_unaccepted_videos: *Client cannot view unaccepted videos* 
- enable_video_subpages: *Enable hosted video pages* 


#### Get Stats 
 
Read application stats 

```php 
$ziggeo->application()->get_stats($arguments = array()) 
``` 
 
Arguments 
- period: *Optional. Can be 'year' or 'month'.* 


### EffectProfiles  

The effect profiles resource allows you to access and create effect profiles for your app. Each effect profile may contain one process or more. 
 

#### Create 
 
Create a new effect profile. 

```php 
$ziggeo->effectProfiles()->create($arguments = array()) 
``` 
 
Arguments 
- key: *Effect profile key.* 
- title: *Effect profile title.* 
- default_effect: *Boolean. If TRUE, sets an effect profile as default. If FALSE, removes the default status for the given effect* 


#### Index 
 
Get list of effect profiles. 

```php 
$ziggeo->effectProfiles()->index($arguments = array()) 
``` 
 
Arguments 
- limit: *Limit the number of returned effect profiles. Can be set up to 100.* 
- skip: *Skip the first [n] entries.* 
- reverse: *Reverse the order in which effect profiles are returned.* 


#### Get 
 
Get a single effect profile 

```php 
$ziggeo->effectProfiles()->get($token_or_key) 
``` 
 


#### Delete 
 
Delete the effect profile 

```php 
$ziggeo->effectProfiles()->delete($token_or_key) 
``` 
 


#### Update 
 
Updates an effect profile. 

```php 
$ziggeo->effectProfiles()->update($token_or_key, $arguments = array()) 
``` 
 
Arguments 
- default_effect: *Boolean. If TRUE, sets an effect profile as default. If FALSE, removes the default status for the given effect* 


### EffectProfileProcess  

The process resource allows you to directly access all process associated with a single effect profile. 
 

#### Index 
 
Return all processes associated with a effect profile 

```php 
$ziggeo->effectProfileProcess()->index($effect_token_or_key, $arguments = array()) 
``` 
 
Arguments 
- states: *Filter streams by state* 


#### Get 
 
Get a single process 

```php 
$ziggeo->effectProfileProcess()->get($effect_token_or_key, $token_or_key) 
``` 
 


#### Delete 
 
Delete the process 

```php 
$ziggeo->effectProfileProcess()->delete($effect_token_or_key, $token_or_key) 
``` 
 


#### Create Filter Process 
 
Create a new filter effect process 

```php 
$ziggeo->effectProfileProcess()->create_filter_process($effect_token_or_key, $arguments = array()) 
``` 
 
Arguments 
- effect: *Effect to be applied in the process* 


#### Create Watermark Process 
 
Attaches an image to a new stream 

```php 
$ziggeo->effectProfileProcess()->create_watermark_process($effect_token_or_key, $arguments = array()) 
``` 
 
Arguments 
- file: *Image file to be attached* 
- vertical_position: *Specify the vertical position of your watermark (a value between 0.0 and 1.0)* 
- horizontal_position: *Specify the horizontal position of your watermark (a value between 0.0 and 1.0)* 
- video_scale: *Specify the image scale of your watermark (a value between 0.0 and 1.0)* 


### MetaProfiles  

The meta profiles resource allows you to access and create meta profiles for your app. Each meta profile may contain one process or more. 
 

#### Create 
 
Create a new meta profile. 

```php 
$ziggeo->metaProfiles()->create($arguments = array()) 
``` 
 
Arguments 
- key: *Meta Profile profile key.* 
- title: *Meta Profile profile title.* 


#### Index 
 
Get list of meta profiles. 

```php 
$ziggeo->metaProfiles()->index($arguments = array()) 
``` 
 
Arguments 
- limit: *Limit the number of returned meta profiles. Can be set up to 100.* 
- skip: *Skip the first [n] entries.* 
- reverse: *Reverse the order in which meta profiles are returned.* 


#### Get 
 
Get a single meta profile 

```php 
$ziggeo->metaProfiles()->get($token_or_key) 
``` 
 


#### Delete 
 
Delete the meta profile 

```php 
$ziggeo->metaProfiles()->delete($token_or_key) 
``` 
 


### MetaProfileProcess  

The process resource allows you to directly access all process associated with a single meta profile. 
 

#### Index 
 
Return all processes associated with a meta profile 

```php 
$ziggeo->metaProfileProcess()->index($meta_token_or_key) 
``` 
 


#### Get 
 
Get a single process 

```php 
$ziggeo->metaProfileProcess()->get($meta_token_or_key, $token_or_key) 
``` 
 


#### Delete 
 
Delete the process 

```php 
$ziggeo->metaProfileProcess()->delete($meta_token_or_key, $token_or_key) 
``` 
 


#### Create Video Analysis Process 
 
Create a new video analysis meta process 

```php 
$ziggeo->metaProfileProcess()->create_video_analysis_process($meta_token_or_key) 
``` 
 


#### Create Audio Transcription Process 
 
Create a new audio transcription meta process 

```php 
$ziggeo->metaProfileProcess()->create_audio_transcription_process($meta_token_or_key) 
``` 
 


#### Create Nsfw Process 
 
Create a new nsfw filter meta process 

```php 
$ziggeo->metaProfileProcess()->create_nsfw_process($meta_token_or_key, $arguments = array()) 
``` 
 
Arguments 
- nsfw_action: *One of the following three: approve, reject, nothing.* 


### Webhooks  

The webhooks resource allows you to create or delete webhooks related to a given application. 
 

#### Create 
 
Create a new webhook for the given url to catch the given events. 

```php 
$ziggeo->webhooks()->create($arguments = array()) 
``` 
 
Arguments 
- target_url: *The url that will catch the events* 
- encoding: *Data encoding to be used by the webhook to send the events.* 
- events: *Comma-separated list of the events the webhook will catch. They must be valid webhook type events.* 


#### Delete 
 
Delete a webhook using its URL. 

```php 
$ziggeo->webhooks()->delete($arguments = array()) 
``` 
 
Arguments 
- target_url: *The url that will catch the events* 


### Analytics  

The analytics resource allows you to access the analytics for the given application 
 

#### Get 
 
Get analytics for the given params 

```php 
$ziggeo->analytics()->get($arguments = array()) 
``` 
 
Arguments 
- from: *A UNIX timestamp in microseconds used as the start date of the query* 
- to: *A UNIX timestamp in microseconds used as the end date of the query* 
- date: *A UNIX timestamp in microseconds to retrieve data from a single date. If set, it overwrites the from and to params.* 
- query: *The query you want to run. It can be one of the following: device_views_by_os, device_views_by_date, total_plays_by_country, full_plays_by_country, total_plays_by_hour, full_plays_by_hour, total_plays_by_browser, full_plays_by_browser* 





## License

Copyright (c) 2013-2018 Ziggeo
 
Apache 2.0 License
