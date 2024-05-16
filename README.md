# ACF Like Button

Final demo site [ACFLikeButton.WPEnginePowered.com](https://acflikebutton.wpenginepowered.com)

This repo contains the source code for a WordPress plugin, which does several things:

1. Registers two post types: movie, song
2. Register ACF Relationship field type and associates it with each user.
3. Includes some CSS and a few other things to allow for [a custom login/register screen](https://acflikebutton.wpenginepowered.com).
4. Registers two custom blocks: Like Button and Like Count. These blocks integrate the [Interactivity API](https://developer.wordpress.org/block-editor/reference-guides/interactivity-api/). When a user clicks the Like Button then it alters the state of the Like Count. Each like is associated with meta information with the user. A user can visit their profile to see a list of all their liked items and edit them as well.

📹 Check out [the playback recording from the ACF Chat Friday on YouTube](https://youtu.be/otFjPLOWWsc) to see the foundation for how this was built. 📹

## Installation & Setup

### Requirements

A WordPress site with:

- [ACF PRO](https://www.advancedcustomfields.com/pro/) plugin installed and activated.
- Current repo's [ACF Like plugin](https://github.com/colorful-tones/acf-like-button/tree/main/plugins/acf-likes), which relies on the ACF PRO plugin being active.
- Current repo's [Interact theme](https://github.com/colorful-tones/acf-like-button/tree/main/themes/interact) installed and activated.
