<?php

interface DownloadsInterface
{
	public function getFileLocation();
	public function createDownloadLink();
}