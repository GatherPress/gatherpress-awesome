# GatherPress Awesome

*GatherPress Awesome* is a starter plugin, an example of how to structure and organize a companion plugin for GatherPress. It uses the entry points provided by GatherPress to show how and where one could hook into the code and its underlying processes.

## Already prepared for your GatherPress Awesome plugin

- [x] Registers your Awesome namespace and adds it to GatherPress' autoloader
- [x] Adds an Awesome settings tab to the GatherPress settings

    <details><summary>Preview</summary>

    ![A new "Awesome" settings tab in the GatherPress settings](https://github.com/user-attachments/assets/585e4cdb-cdde-4373-b999-b35aaca06c5e)

    </details> 

- [x] Test [GatherPress Awesome in Playground](https://playground.wordpress.net/builder/builder.html?blueprint-url=https://raw.githubusercontent.com/GatherPress/gatherpress-awesome/main/.wordpress-org/blueprints/blueprint.json), with GatherPress installed & [gatherpress-demo-data](https://github.com/GatherPress/gatherpress-demo-data) already in place.

    <details><summary>Preview</summary>

    ![GatherPress & GatherPress Awesome pre-installed and activated in WordPress Playground](https://github.com/user-attachments/assets/011742dc-2fa9-4b7b-b10f-8023cc7b77af)

    </details> 

## Up to you

- [ ] [Activate the `Awesome_Endpoints` demo](https://raw.githubusercontent.com/GatherPress/gatherpress/main/docs/developer/custom-url-endpoints#example-1--add-events-to-office365-calendar) from the GatherPress developer documentation, to enable a new 'Add to calendar' endpoint for *Office365*.

	![Screenshot from the 'Rewrite Analyzer' plugin page with a matching rewrite for office365-endpoint from this example.](https://raw.githubusercontent.com/GatherPress/gatherpress/main/docs/developer/custom-url-endpoints/custom-url-endpoints__office365-calendar.png)

- [ ] [Create your own GatherPress Awesome demo-data](https://github.com/carstingaxion/crud-the-docs-playground), and add it to your [`blueprint.json`](/.wordpress-org/blueprints/blueprint.json).
