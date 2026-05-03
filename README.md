# GatherPress Awesome

A starter plugin for building **companion plugins** that extend [GatherPress](https://github.com/GatherPress/gatherpress) — the WordPress plugin for community event management.

It's not meant to ship as-is. Clone it, rename it, and use it as a working scaffold for your own GatherPress add-on.

## What you get out of the box

- Plugin bootstrap that **registers the dependency on GatherPress** (`Requires Plugins: gatherpress`) so WordPress 6.5+ surfaces it on the Plugins screen and won't activate the companion without it.
- An **admin notice** if GatherPress isn't loaded for any reason, so the failure mode is visible instead of silent.
- A **duplicate-folder guard** that bails when a sibling copy is already loaded (for example, if WordPress includes `gatherpress-awesome-2/` alongside `gatherpress-awesome/`).
- Registration with GatherPress's **coexistence guard**, so two folders of the same companion plugin can't both activate.
- Your namespace **wired into GatherPress's class autoloader**, so dropping `includes/classes/class-foo.php` is enough to load `GatherPress_Awesome\Foo`.
- An **"Awesome" settings sub-page** rendered inside *Settings → GatherPress* — the simplest example of hooking into GatherPress's UI.

    <details><summary>Preview</summary>

    ![A new "Awesome" settings tab in the GatherPress settings](https://github.com/user-attachments/assets/585e4cdb-cdde-4373-b999-b35aaca06c5e)

    </details>

- A ready-to-go **[Playground blueprint](https://playground.wordpress.net/builder/builder.html?blueprint-url=https://raw.githubusercontent.com/GatherPress/gatherpress-awesome/main/.wordpress-org/blueprints/blueprint.json)** that boots WordPress with both GatherPress and this companion installed, plus [gatherpress-demo-data](https://github.com/GatherPress/gatherpress-demo-data) already in place.

    <details><summary>Preview</summary>

    ![GatherPress & GatherPress Awesome pre-installed and activated in WordPress Playground](https://github.com/user-attachments/assets/011742dc-2fa9-4b7b-b10f-8023cc7b77af)

    </details>

- An `uninstall.php` scaffold that walks the multisite blog list and deletes a placeholder option — swap in your own option names when you start storing data.

## File layout

```
gatherpress-awesome/
├── gatherpress-awesome.php        # Plugin bootstrap (header, autoloader, boot guard, coexistence guard)
├── uninstall.php                  # Multisite-aware option cleanup on uninstall
├── includes/classes/
│   └── class-setup.php            # Singleton entry point — register your hooks here
├── .wordpress-org/blueprints/
│   └── blueprint.json             # Playground boot recipe
└── package.json                   # @wordpress/scripts (build, lint, format, plugin-zip)
```

## Quick start

1. **Clone** the repository into your local `wp-content/plugins/` directory and rename the folder to whatever you want (e.g., `gatherpress-myplugin`).
2. **Find-and-replace** these tokens across every file (case-sensitive):
   - `gatherpress-awesome` → `gatherpress-myplugin`
   - `gatherpress_awesome` → `gatherpress_myplugin`
   - `GATHERPRESS_AWESOME` → `GATHERPRESS_MYPLUGIN`
   - `GatherPress_Awesome` → `GatherPress_Myplugin`
   - `GatherPress Awesome` → `GatherPress Myplugin`
3. **Rename the entry file**: `gatherpress-awesome.php` → `gatherpress-myplugin.php`. The filename, the folder name, and the slug passed to `gatherpress_register_coexistence_guard()` must all match.
4. **Update `package.json`** (name, description, repository) and bump the plugin header `Version`.
5. **Activate** GatherPress + your renamed companion in WordPress.

## Where to extend

Most of your work happens inside `GatherPress_Awesome\Setup::setup_hooks()` (or new sibling classes you autoload via the same namespace). Common extension points GatherPress exposes:

- **Hooks** — see [`docs/developer/hooks/`](https://github.com/GatherPress/gatherpress/tree/develop/docs/developer/hooks) in the GatherPress repo for the full filter and action catalog (auto-generated on every release).
- **Block patterns** — register your own starter patterns via `gatherpress_event_starter_patterns` and `gatherpress_venue_starter_patterns` filters; see the [pattern picker docs](https://github.com/GatherPress/gatherpress/tree/develop/docs/developer/blocks).
- **Settings sub-pages** — the `gatherpress_sub_pages` filter is what wires the Awesome tab demo. Add fields to your sub-page using GatherPress's settings API.
- **Block hooks** — extend the canonical event/venue layouts via the `hooked_block_types` WordPress core API; see the [hookable patterns docs](https://github.com/GatherPress/gatherpress/tree/develop/docs/developer/blocks/hookable-patterns).

## Up to you

- [ ] [Create your own demo-data plugin](https://github.com/carstingaxion/crud-the-docs-playground) and reference it from your `.wordpress-org/blueprints/blueprint.json` so reviewers can spin up a representative sandbox in one click.

## License

GPLv2 or later. See `LICENSE` in this repository.
