<?php

/*
ZetCode PHP GTK tutorial

This program centers a window on
the screen.

author: Jan Bodnar
website: www.zetcode.com
last modified: September 2011
*/

class Example extends GtkWindow {


    public function __construct() {

        parent::__construct();


        $this->set_title('Simple');
        $this->set_default_size(250, 150);

        $this->connect_simple('destroy', array('gtk', 'main_quit'));

        $this->set_position(GTK::WIN_POS_CENTER);
        $this->show();
    }
}

new Example();
Gtk::main();
?>
