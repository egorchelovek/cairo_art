<?php

class SimpleWindow extends GtkWindow {

  public function __construct() {
    parent::__construct();

    $this->set_title("Picture view");
    $this->set_default_size(640,480);
    $this->set_position(GTK::WIN_POS_CENTER);

    $this->connect_simple('destroy', array('gtk', 'main_quit'));

    $this->show();
  }
}

// new SimpleWindow();
// Gtk::main();
?>
