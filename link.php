<?php
$window = new GtkWindow();
$window->set_size_request(400, 300);

$window->connect_simple('destroy', array('Gtk','main_quit'));

$window->add($vbox = new GtkVBox());

// displays a title
$title = new GtkLabel();
$title->set_markup('<span color="blue" font_desc="Times New Roman Italic 12">
    Clilckable Link</span>');
$title->set_size_request(-1, 80);
$title->set_alignment(0.5, 0.5);
$vbox->pack_start($title, 0, 0); // note 7

// create the clickable label
$clickable_label = new GtkHBox();
$clickable_label->set_size_request(-1, 24);
$vbox->pack_start($clickable_label,0 ,0);
$clickable_label->pack_start(new GtkLabel("reference: php-gtk2 "), 0, 0);
$clickable_label->pack_start(make_link("manual", "http://gtk.php.net/manual/en/gtkclasses.php"));
$clickable_label->pack_start(new GtkLabel(" and "), 0, 0);
$clickable_label->pack_start(make_link("mailing list", "http://www.nabble.com/Php---GTK---General-f171.html"));

$vbox->pack_start(new GtkLabel('')); // note 6

$status = new GtkLabel(''); // note 1
$status->set_alignment(0, 0);
$vbox->pack_start($status, 0, 0);

// function to setup the link
function make_link($title, $url) {
    $label = new GtkLabel($title);
    $label->set_markup('<span color="blue"><u>'.$title."</u></span>");
    $eventbox = new GtkEventBox;
    $eventbox->add($label);
    $eventbox->connect('button-press-event', 'link_clicked', $title, $url);
    $eventbox->connect('enter-notify-event', 'link_hover', $title, $url); // note 2
    $eventbox->connect('leave-notify-event', 'link_leave', $title, $url); // note 3
    return $eventbox;
}

// call-back function when user click on the link
function link_clicked($widget, $event, $title, $url) {
    print "title = $title\n";
    print "url = $url\n";
    // do your action here, e.g. launch the url in browser
}

function link_hover($widget, $event, $title, $url) { // note 4
    global $status;
    $status->set_text($url);
}

function link_leave($widget, $event, $title, $url) { // note 5
    global $status;
    $status->set_text('');
}

$window->show_all();
Gtk::main();
?>