A minimal, yet functional frontpage in PHP

This project is basically a hobby project. Yet placed it on GitHub to show people how you can use MongoDB, PHP and AJAX together.

# Preview

![Frontpage preview](http://i.imgur.com/PUXFJ.png)

# Features

*   **Fully AJAX**: Tab-switching, option-toggling and widget refreshing has AJAX support, so no unneeded full-page refreshing.
*   **One grid of favorites tabs per tab**: An unlimited number of tabs can be added and each tab has it's own grid. Each cell in the grid has a button (hidable) to either edit or delete the cell. 
*   **Settings**: The grid can enlarged or reduced in size at the settings page.
*   **Google**: Basic Google search bar available.
*   **Widgets**: A handy widgets bar at the right of the screen with the latest new, strips and feeds. A new widget can be added fast. Each stylesheet, JavaScript and PHP file of each widget has its widget "project" folder, so a great spatial organisation.

# Current Widgets

1.  **XKCD (http://www.xkcd.com)**: The latest strip of XKCD.
2.  **NOS (http://www.nos.nl)**: The latest news of the NOS.
3.  **AppStorm (http://mac.appstorm.net/)**: The latest feed of Mac news on AppStorm.
4.  **Penny Arcade (http://www.pennyarcade.com)**: The latest strip of Penny Arcade.
5.  **Quotes**: Store quotes locally and review them later.

# Database structure

At the moment there are **four** collections in the Mongo database:

1.  **links**: This collection contains all documents describing each link in the grid. The structure of a document:
    -   **_id**: Auto-generated unique id of the document.
    -   **name**: The name of the link (displayed).
    -   **url**: The URL of the link.
    -   **locationX**: The location expressed in X of the grid.
    -   **locationY**: The location expressed in Y of the grid.
    -   **tabId**: The unique id of the tab to which the links are addressed.
2.  **settings**: This collection contains one document for the settings of the Frontpage. The structure of a document:
    -   **_id**: Auto-generated unique id of the document.
    -   **frontpage**:
        -   **title**: The title displayed at the frontpage.
    -   **grid**:
        -   **width**: The width of the grid (propagated to each grid per tab, no individual width yet).
        -   **height**: The height of the grid (idem).
    -   **newWindow**: A boolean value whether a link should open in a new window or not.
3.  **tabs**: This collection contains all documents describing each tab. The structure of a document:
    -   **_id**: Auto-generated unique id of the document.
    -   **name**: The name of the tab (displayed).
    -   **position**: The absolute position in the list of tab documents.
4.  **quotes**: This collection contains all documents describing each quote. The structure of a document:
    -   **_id**: Auto-generated unique id of the document.
    -   **text**: The text of the quote.
    -   **author**: The author of the quote.