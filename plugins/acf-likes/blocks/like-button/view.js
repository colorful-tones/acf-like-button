/**
 * WordPress dependencies
 */
import { store, getContext } from "@wordpress/interactivity";

import './view.css';

const { actions, state } = store('wpe/like-button', {
	state: {
		isItemIncluded() {
			const context = getContext();
			return state.likedItems.includes( context.post.id );
		}
	},
	actions: {
		toggleLike() {
			const context = getContext();

			const index = state.likedItems.findIndex(
				(post) => post === context.post.id
			);
			
			if ( index === -1 ) {
				state.likedItems.push( context.post.id );
			} else {
				state.likedItems.splice( index, 1 );
			}
			state.likesCount = state.likedItems.length;
			state.isLikedItemsNotEmpty = state.likedItems.length > 0;
			actions.updateUserLikes();
		},
		*updateUserLikes() {
			const formData = new FormData();

			formData.append( 'action', 'submit_like' );
			formData.append( 'nonce', state.nonce );
			formData.append( 'likedItems', JSON.stringify(state.likedItems) );
			formData.append( 'userId', state.userId );

			try {
				yield fetch(
					state.ajaxUrl,
					{
						method: 'POST',
						credentials: 'same-origin',
						body: formData,
					}
				).then(
					r => r.text()
				)
			} catch( error ) {
				console.error( 'Error:', error );
			}
		}
	},
});