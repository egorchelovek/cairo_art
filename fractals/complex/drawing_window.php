<?php

abstract class FractalDrawingWindow extends GtkWindow {

  var $centerX = 0.;
  var $centerY = 0.;
  var $scale = 1.;
  var $ftype = 0;

  public function FractalDrawingWindow() {
    parent::__construct();

    $this->set_title($this->getName());
    $this->connect_simple('destroy', array('gtk', 'main_quit'));

    $this->connect('key-press-event', array($this, 'onKeyPress'));

    $drawingArea = new GtkDrawingArea();
    $drawingArea->connect('expose_event',array($this,'onExpose'));
    $drawingArea->set_size_request(640,480);

    $labelCenter = new GtkLabel('Center',true);
    $labelScale = new GtkLabel('Scale', true);
    $labelType = new GtkLabel('Type', true);

    $textCenterX = new GtkEntry(strval($this->centerX));
    $textCenterY = new GtkEntry(strval($this->centerY));
    $textScale = new GtkEntry(strval($this->scale));
    $comboType = GtkComboBox::new_text();

    foreach($this->getRegisteredFractals() as $fractal){
      $comboType->append_text($fractal->getTypeName());
    }
    $comboType->set_active($this->type);

    $submitButton = new GtkButton('Submit');
    $submitButton->connect('clicked', array($this,'submit'), $drawingArea, $textCenterX, $textCenterY, $textScale, $comboType);

    $progress = new GtkProgressBar();

    $vbox = new GtkVBox(false,0);
    $vbox->pack_start($drawingArea,false,false,0);

    $vbox->pack_start($progress, false, false, 0);

    $controlTable = new GtkTable(3,3);
    $controlTable->attach($labelCenter,  0,1, 0,1);
    $controlTable->attach($textCenterX,  1,2, 0,1);
    $controlTable->attach($textCenterY,  2,3, 0,1);

    $controlTable->attach($labelScale,   0,1, 1,2);
    $controlTable->attach($textScale,    1,2, 1,2);

    $controlTable->attach($labelType,    0,1, 2,3);
    $controlTable->attach($comboType,    1,2, 2,3);

    $controlTable->attach($submitButton, 2,3, 1,3);

    $vbox->pack_start($controlTable, false,false,0);
    $this->add($vbox);

    // $this->set_default_size(512,512);
    $this->set_position(GTK::WIN_POS_CENTER);

    Gtk::timeout_add(200,array($this,'updateProgress'), $progress);

    $this->show_all();
  }

  function onExpose($drawingArea, $event){
    $context = $drawingArea->window->cairo_create();
    $this->onDraw($context);
  }

  function onKeyPress($widget, $event){
    if ($event->keyval == Gdk::KEY_q) {
        $widget->destroy();
    }
  }

  function submit($widget, $drawingArea, $textCenterX, $textCenterY, $textScale, $comboType){
    $this->centerX = floatval($textCenterX->get_text());
    $this->centerY = floatval($textCenterY->get_text());
    $this->scale = floatval($textScale->get_text());
    $this->ftype = intval($comboType->get_active());

    $this->set_title($this->getName());
    $drawingArea->queue_draw();
  }

  function updateProgress($progress){
    $progress->set_fraction($this->getState());
    return true;
  }

  abstract public function getState();
  abstract public function getName();
  abstract public function getRegisteredFractals();
  abstract protected function onDraw($context);
}
?>
