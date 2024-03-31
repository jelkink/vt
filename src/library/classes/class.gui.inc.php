<?php

class GUI {

  private $header = "<title>Vortapilkoj</title>\n" .
    "<link rel=\"stylesheet\" href=\"vt.css\">\n" .
    "<link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"favicon.ico\">\n" .
    "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">\n";
  private $top = "<h1>Vortapilkoj</h1>\n";
  private $right = "";
  private $center = "";
  private $left = "";

  function GUI() {}

  function AddHeader($html) {

    $this->header .= $html . "\n";
  }

  function AddTop($html) {

    $this->top .= $html . "\n";
  }

  function AddRight($html) {

    $this->right .= $html . "\n";
  }

  function AddLeft($html) {

    $this->left .= $html . "\n";
  }

  function AddCenter($html) {

    $this->center .= $html . "\n";
  }

  function Log($text) {

    $this->AddRight("$text</br>\n");
  }

  function Render() {

    echo "<html><head>\n";
    echo "\n$this->header\n\n";
    echo "</head><body>\n";
    echo "$this->top\n\n";
    if (strlen($this->left) > 0) echo "<div class=\"xleftcol\">\n$this->left\n</div>\n\n";
    echo "<div class=\"xmiddlecol\">\n$this->center\n</div>\n\n";
    if (strlen($this->right) > 0) echo "<div class=\"xrightcol\">\n$this->right\n</div>\n\n";
    echo "</body></html>\n";
  }
}

?>
