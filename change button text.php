<?php
$window = new GtkWindow();
$window->set_size_request(480, 240);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Change the font and font size of GtkButton");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$title->set_justify(Gtk::JUSTIFY_CENTER);
$alignment = new GtkAlignment(0.5, 0, 0, 0);
$alignment->add($title);
$vbox->pack_start($alignment, 0, 0);
$vbox->pack_start(new GtkLabel(), 0, 0);

// setup button
$button = new Gtkbutton("hello world!");
$button_label = $button->get_child(); // note 1
$button_label->modify_font(new PangoFontDescription('Eras Demi ITC 32')); // note 2
$button->connect('clicked', 'on_click');
$vbox->pack_start($button, 0);

$window->show_all();
Gtk::main();

function on_click($widget) {
    $dialog = new GtkDialog('Alert', null, Gtk::DIALOG_MODAL);
	$dialog->set_size_request(200,300);
    $dialog->set_position(Gtk::WIN_POS_CENTER_ALWAYS);
	$dialog->vbox->pack_start($hbox = new GtkHbox());
	$hbox->pack_start(new GtkLabel("Amit Kumar Mondal"));
	$dialog->show_all();
	$dialog->run();
	$dialog->destroy();
}

?>