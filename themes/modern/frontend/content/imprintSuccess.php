<?php

  slot('page_type', 'imprint');
  slot('robots', 'noindex, follow');
  
  echo $sf_data->getRaw('content');
  
?>