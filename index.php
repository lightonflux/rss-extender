<?php
//
// index.php
//
// Author:
//      Lars Formella <ich@larsformella.de>
//
// Copyright (c) 2012 Lars Formella
//
// This program is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
//

require_once(__DIR__ . "/RssExtender.php");
$rssExtender = new RssExtender();

// print the feed
if (isset($_GET['feed']))
{
	$feed = $rssExtender->getFeed($_GET['feed']);
	if (!is_null($feed))
	{
		echo $rssExtender->getFeedContent($feed, isset($_GET['nocache']) ? $_GET['nocache'] : true);
	}
	else
	{
		echo "Feed " . $_GET['feed'] . " not found";
	}
}
// print the overview
else
{
	echo "<html><head><title>RSS-Feeds</title>\n";
	echo "<style>h1{text-align:center} .feed{margin-left: auto; margin-right: auto; width:600px; padding: 10px; margin-bottom: 4px; border: solid thin black}</style>\n";
	echo "</head><body>\n";
	echo "<h1>Available Feeds:</h1>\n";

	$feeds = $rssExtender->getFeeds();
	foreach ($feeds as $feed)
	{
		echo "<div class='feed'>";
		echo "<img src='" . $feed->baseUrl . "/favicon.ico' height='16' width='16' /> " . $feed->baseUrl . " <strong>(" . $feed->name . ")</strong> <small>(von <a href='" . $feed->authorUrl . "'>" . $feed->author . "</a>)</small><br><br><a href='?feed=" . $feed->name . "'>" . $feed->url . "</a>\n";
		echo "</div>\n";
	}

	echo "</body></html>";
}
