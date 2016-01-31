<?php
  // Function returns Steam status (default timeout: 5 seconds)
  function get_steam_status($steamID64, $timeout = 5) {
    $context = stream_context_create(array('http' => array('timeout' => $timeout)));
    $file = @file_get_contents('http://steamcommunity.com/profiles/' . $steamID64 . '/?xml=1', false, $context);
    $xml = simplexml_load_string($file);
    if (isset($xml->onlineState)) {
      $online_state = (string)$xml->onlineState;
      $state_message = ($online_state == 'offline' ? 'Offline' : (string)$xml->stateMessage);
    } else {
      // Error loading profile
      $online_state = 'offline';
      $state_message = 'Offline';
    }
    $state_css = array('online' => 'on', 'in-game' => 'ing', 'offline' => 'off');
    return ' <font color="green"><b><span class="steam_' . $state_css[$online_state] . $steamID64 . '/" target="_blank">' . $state_message . '</a></span></b></font>';
  }

  // ID = Last part of your profile url (http://steamcommunity.com/profiles/...)
  echo get_steam_status('YOUR STEAM-64 ID');
  // If you need Help so write a Comment on Github https://github.com/RatexIndex/Steam-Bot-Status
?>