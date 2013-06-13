# Twitter User Timeline

Really quick PHP script to get one specific user's timeline.

This complies with Twitter's API changes, which no longer allow unauthenticated calls to public timelines.

* Uses [simple file-cache](https://github.com/jonknee/JG_Cache) library to cache results, so high traffic sites don't hit the API rate limit
* "Borrows" Twitter oAuth code from [EE_Twitter](https://github.com/click-rain/EE_Twitter) ExpressionEngine add-on.
