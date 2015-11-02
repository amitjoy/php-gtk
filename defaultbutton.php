<?php
$dialog = new GtkDialog();
$dialog->connect_simple('destroy', array( 'Gtk', 'main_quit'));
$dialog->set_size_request(400,150);

// display title
$title = new GtkLabel("Set Default Button - Part 1\n".
"using set_default_response");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$title->set_justify(Gtk::JUSTIFY_CENTER);
$alignment = new GtkAlignment(0.5, 0, 0, 0);
$alignment->add($title);
$dialog->vbox->pack_start($alignment, 0, 0);
$dialog->vbox->pack_start(new GtkLabel(), 0, 0);

$dialog->add_buttons(array('button 1', 100, // note 1
'button 2', 101, 
'button 3', 102)); 

$dialog->set_default_response(101); // note 2

$dialog->set_has_separator(0);
$dialog->show_all();
$response = $dialog->run();

echo "response = $response\n";
?>