<?php
$window = new GtkWindow();
$window->set_size_request(400, 200);
$window->set_title('launch browser');

$window->connect_simple('destroy', array('Gtk','main_quit'));

$window->add($vbox = new GtkVBox());

// displays a title
$title = new GtkLabel("Launch External Application in windows\n  without the flashing of cmd window");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$vbox->pack_start($title, 0, 0);
$vbox->pack_start(new GtkLabel(''));

// create the clickable label
$clickable_label = new GtkHBox();
$clickable_label->set_size_request(-1, 24);
$vbox->pack_start($clickable_label,0 ,0);
$clickable_label->pack_start(new GtkLabel("reference: php-gtk2 "), 0, 0);
$clickable_label->pack_start(link("manual", "http://gtk.php.net/manual/en/gtkclasses.php"), 0, 0);
$clickable_label->pack_start(new GtkLabel(" and "), 0, 0);
$clickable_label->pack_start(link("mailing list", "http://www.nabble.com/Php---GTK---General-f171.html"), 0, 0);

//$vbox->pack_start(new GtkLabel(''));

$status = new GtkLabel('');
$status->set_alignment(0, 0);
$vbox->pack_start($status, 0, 0);

// function to setup the link
function link($title, $url) {
    $label = new GtkLabel($title);
    $label->set_markup('<span color="blue"><u>'.$title."</u></span>");
    $eventbox = new GtkEventBox;
    $eventbox->add($label);
    $eventbox->connect('button-press-event', 'on_click', $title, $url);
    $eventbox->connect('enter-notify-event', 'on_enter', $title, $url);
    $eventbox->connect('leave-notify-event', 'on_leave', $title, $url);
    return $eventbox;
}

function on_click($widget, $event, $title, $url) {
    $shell = new COM('WScript.Shell'); // note 1
    $shell->Run('cmd /c start "" "' . $url . '"', 0, FALSE); // note 1
   unset($shell);
}

function on_enter($widget, $event, $title, $url) {
    global $status;
    $status->set_text($url);
}

function on_leave($widget, $event, $title, $url) {
    global $status;
    $status->set_text('');
}

$window->show_all();
Gtk::main();
?>