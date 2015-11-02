<?php

$login_success = login(); // calls the login function
if (!$login_success) exit(0); // exit if login not successful

// starts the main program only if login successful
$window = new GtkWindow();
$window->set_size_request(400, 150);
$window->connect_simple('destroy', array('Gtk','main_quit'));
$window->add($vbox = new GtkVBox());

// display title
$title = new GtkLabel("Login prompt - Part 1");
$title->modify_font(new PangoFontDescription("Verdana Bold 10"));
$title->modify_fg(Gtk::STATE_NORMAL, GdkColor::parse("#0000ff"));
$title->set_size_request(-1, 40);
$vbox->pack_start($title, 0, 0);

$vbox->pack_start(new GtkLabel("User verified"));
$vbox->pack_start(new GtkLabel("Main program starts..."));

// the login function
function login() {
    $count = 0;
    while ($count<3) {
        $data = get_data("Login", array("Username:", "Password:")); // get username and passwd
        list($username, $password) = $data; // result of user input is returned as an array
        if ($username=='user1' && $password=='phpgtk2') { // validate username and password
            return true; // ok!
        } else {
            alert("Incorrect username and password!\nHint: username=user1\npassword=phpgtk2");
            // not ok. alert user - note 2
        }
        ++$count;
    }
    return false;
}

// display a popup dialog box to prompt for data
function get_data($title, $field_labels) {
    $dialog = new GtkDialog($title, null, Gtk::DIALOG_MODAL); // create a new dialog
    $dialog->set_position(Gtk::WIN_POS_CENTER_ALWAYS);
    $top_area = $dialog->vbox; // get the top area
    $top_area->pack_start($hbox = new GtkHBox());
    $stock = GtkImage::new_from_stock(Gtk::STOCK_DIALOG_QUESTION, Gtk::ICON_SIZE_DIALOG);
    $hbox->pack_start($stock, 0, 0); // stuff in the icon

    // display the data entry form as table
    $table = new GtkTable(); // create a new table
    $row = 0;
    $input = array(); // holds the ID of each GtkEntry
    foreach ($field_labels as $field_label) {
        $label = new GtkLabel($field_label);
        $label->set_alignment(0,0); // left-justify the label
        $table->attach($label, 0, 1, $row, $row+1); // insert the label into table
        $input[$row] = new GtkEntry(); // create a new input field
        $table->attach($input[$row], 1, 2, $row, $row+1); // add this besides the label
        if (eregi("password", $field_label))
            $input[$row]->set_visibility(false); // show password entry as '*'
        ++$row;
    }
    $hbox->pack_start($table);
    $dialog->add_button(Gtk::STOCK_OK, Gtk::RESPONSE_OK); // add an OK button
    $dialog->set_has_separator(false); // don't display the set_has_separator
    $dialog->show_all(); // show the dialog
    $dialog->run(); // the dialog in action

    // grab the user input before destroying the dialog - note 1
    $data = array(); // put user input in an array
    for ($i=0; $i<count($input); ++$i) {
        $data[] = $input[$i]->get_text();
    }
    $dialog->destroy(); // done. close the dialog box.
    return $data; // returns the user input as array
}

// display popup alert box - note 2
function alert($msg) {
    $dialog = new GtkDialog('Alert', null, Gtk::DIALOG_MODAL);
    $dialog->set_position(Gtk::WIN_POS_CENTER_ALWAYS);
    $top_area = $dialog->vbox;
    $top_area->pack_start($hbox = new GtkHBox());
    $stock = GtkImage::new_from_stock(Gtk::STOCK_DIALOG_WARNING,
        Gtk::ICON_SIZE_DIALOG);
    $hbox->pack_start($stock, 0, 0);
    $hbox->pack_start(new GtkLabel($msg));
    $dialog->add_button(Gtk::STOCK_OK, Gtk::RESPONSE_OK);
    $dialog->set_has_separator(false);
    $dialog->show_all();
    $dialog->run();
    $dialog->destroy();
}

$window->show_all();
Gtk::main();

?>