# Server side Google Analytics proxy

## Introduction
This code creates a service side proxy to Google Analytics using the [Google Analytics Measurement Protocol](https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide).

_Warning: This code is far from feature complete and is more a MVP to log `page view` and `events`_

## Installation
Copy `config.example.php` to `config.php` and set the values in `config.php`.

For more security replace `e0b3d458-b76e-40f5-b186-86ca96a4a578` with your own GUID or unique string.

## Running
Install the files on your server, for debugging you can run `php -S localhost:8000` in the `src` folder to run it locally.

## Postman
[Postman](https://www.getpostman.com/) is a tool to make server calls. Inside the Postman folder, you'll find Postman script to test the API.

## API

### Pageview

#### Url
`http://localhost:8000?type=page_view&title=Test article 1&path=articles/test-article-1`

#### Parameters
```
type   Analytics call type
title  Title of the page
path   URI of the page without slash at beginning
```

### Event

#### Url
`http://localhost:8000?type=event&category=shopping&action=purchase&label=amount&value=123.45`

#### Parameters
```
type      Analytics call type
category  Event category
action    Event action
label     Event label
value     Event value
```
