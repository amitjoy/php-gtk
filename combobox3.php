<?php
$window = new GtkWindow();
$window->connect_simple('destroy', array( 'Gtk', 'main_quit'));
$window->set_size_request(400,150);

$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Setup GtkComboBox with label-value pair");
$title->modify_font(new PangoFontDescription("Times New Roman Italic 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 60);
$vbox->pack_start($title, 0, 0);

$vbox->pack_start($hbox=new GtkHBox(), 0, 0);
$hbox->pack_start(new GtkLabel('Select: '), 0, 0);

// the month label-value pair
$month_options = array( // note 1
'Januaary' => '01',
'February' => '02',
'March' => '03',
'April' => '04',
'May' => '05',
'June' => '06',
'July' => '07',
'August' => '08',
'September' => '09',
'October' => '10',
'November' => '11',
'December' => '12',
);

// Create a combobox
$combobox = GtkComboBox::new_text(); // note 2

// populates the options
foreach($month_options as $label=>$value) {
    $combobox->append_text($label); // note 3
}

// Set up a hbox to contain the combobox as well as the Submit button
$hbox->pack_start($combobox, 0, 0);
$hbox->pack_start(new GtkLabel('  '), 0, 0);
$hbox->pack_start($button = new GtkButton('Submit'), 0, 0);
$button->set_size_request(60, 24);

// Set up the event handler to respond to button click
$button->connect('clicked', "on_button", $combobox);

// The callback function that is called when user clicks the submit button
function on_button($button, $combobox) {
    global $month_options;
    $selection = $combobox->get_active_text(); // note 4
    $value = $month_options[$selection]; // note 5
    echo "You have selected: $selection (value = $value)!\n";
}

$window->show_all();
Gtk::main();
?>