<?php
$window = new GtkWindow();
$window->connect_simple('destroy', array( 'Gtk', 'main_quit'));
$window->set_size_request(400,150);

$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Setup and process GtkComboBox");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 60);
$vbox->pack_start($title, 0, 0);

// the selection
$list = array('item 1', 'item 2', 'item 3', 'item 4');

$vbox->pack_start($hbox=new GtkHBox(), 0, 0);
$hbox->pack_start(new GtkLabel('Select: '), 0, 0);

// Create a combobox
$combobox = new GtkComboBox();

// Create a model
if (defined("GObject::TYPE_STRING")) {
    $model = new GtkListStore(GObject::TYPE_STRING);
} else {
    $model = new GtkListStore(Gtk::TYPE_STRING);
}

// Set up the combobox
$combobox->set_model($model); // note 1
$cellRenderer = new GtkCellRendererText(); // note 2
$combobox->pack_start($cellRenderer);
$combobox->set_attributes($cellRenderer, 'text', 0); // note 3

// Stuff the choices in the model
foreach($list as $choice) {
    $model->append(array($choice));
}

// Set up a hbox to contain the combobox as well as the Submit button
$hbox->pack_start($combobox, 0, 0);
$hbox->pack_start(new GtkLabel('  '), 0, 0);
$hbox->pack_start($button = new GtkButton('Submit'), 0, 0);
$button->set_size_request(60, 24);

// Set up the event handler to respond to button click
$button->connect('clicked', "on_button", $combobox); // note 4

// The callback function that is called when user clicks the submit button
function on_button($button, $combobox) {
    $model = $combobox->get_model(); // note 5
    $selection = $model->get_value($combobox->get_active_iter(), 0); // note 6
    echo "You have selected: $selection!\n";
}

$window->show_all();
Gtk::main();
?>