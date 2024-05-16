/**
 * WordPress dependencies
 */
import { store } from "@wordpress/interactivity";

import './view.css';

const { state } = store('wpe/like-button', {
	state: {
		likesCount: () => state.likedItems.length,
		isLikedItemsNotEmpty: () => state.likedItems.length !== 0,
	}
});

