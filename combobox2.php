<?php
$window = new GtkWindow();
$window->connect_simple('destroy', array( 'Gtk', 'main_quit'));
$window->set_size_request(400,150);

$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Setup and read value from ComboBoxEntry");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 60);
$vbox->pack_start($title, 0, 0);

// the selection
$list = array('item 1', 'item 2', 'item 3', 'item 4');

$vbox->pack_start($hbox=new GtkHBox(), 0, 0);
$hbox->pack_start(new GtkLabel('Select: '), 0, 0);

// Create a new comboboxentry and populates it
$combobox = GtkComboBoxEntry::new_text();
foreach($list as $choice) {
    $combobox->append_text($choice);
}
$combobox->get_child()->set_text(''); // note 1
$hbox->pack_start($combobox);

// Set up the submit butotn
$hbox->pack_start($button = new GtkLabel('  '), 0, 0);
$hbox->pack_start($button = new GtkButton('Submit'), 0, 0);
$button->set_size_request(60, 24);

// Set up the event handler to respond to button click
$button->connect('clicked', "on_button", $combobox); //note 2

// The callback function that is called when user clicks the submit button
function on_button($button, $combobox) {
    $selection = $combobox->get_child()->get_text(); // note 3
    print "You have selected: $selection\n";
}

$window->show_all();
Gtk::main();
?>