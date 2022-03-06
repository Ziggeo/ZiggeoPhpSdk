This readme will show you how to run demos and how they are organized

# How to call demos through console

If you want to use the code from `videos_count.php` you would want to open it and see what parameters it requires.

In its case this is important to us `getopt("", array("app_token:", "private_key:"));`

It means that we need to pass `app_token` and `private_key` to our script.

## We would do it like so:

```php videos_count.php --app_token "APP_TOKEN" --private_key "PRIVATE_KEY"```

So every file will have its own parameters, however they will always be called out like so:

```php filename.php --parameter1 "parameter1_value" --parameter2 "parameter2_value"```

# Organization

The demos are organized by the class and function name. So for example if you want to see how to get the count of the videos you would find it in the name that matches the same:
 1. videos()
 2. count()

...making the filename "videos_count.php"

The scripts that are created to help with different things like benchmarks (_benchmark.php) and alike, are prefixed with an underscore and then match the similar structure as above to help you separate it all (however they can have any filename that describes action or multiple actions).
