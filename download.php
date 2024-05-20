<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get video URL and platform from the form
    $videoUrl = $_POST["videoUrl"];
    $platform = $_POST["platform"];

    // Function to download video based on platform
    function downloadVideo($videoUrl, $platform) {
        // Send POST request to youtube-dl-web API
        $ch = curl_init('https://www.yt-download.org/api/widget/mp3/' . urlencode($videoUrl));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response
        $data = json_decode($response, true);

        // Check if download URL exists
        if (isset($data['url'])) {
            // Return the download link
            return $data['url'];
        } else {
            return "Error: Unable to get download link.";
        }
    }

    // Download the video
    $downloadLink = downloadVideo($videoUrl, $platform);

    // Return the download link
    echo $downloadLink;
}
?>
