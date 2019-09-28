<?php

abstract class FractalDrawingWindow extends GtkWindow {

  public function FractalDrawingWindow() {
    parent::__construct();

    $this->set_title($this->getName());
    $this->connect_simple('destroy', array('gtk', 'main_quit'));

    $drawingArea = new GtkDrawingArea();
    $drawingArea->connect('expose_event',array($this,'onExpose'));
    $this->add($drawingArea);

    $this->set_default_size(640,480);
    $this->set_position(GTK::WIN_POS_CENTER);

    $this->show_all();
  }

  public function onExpose($darea, $event){
    $context = $darea->window->cairo_create();
    $this->onDraw($context);
  }

  abstract public function getName();
  abstract protected function onDraw($context);
}
?>
