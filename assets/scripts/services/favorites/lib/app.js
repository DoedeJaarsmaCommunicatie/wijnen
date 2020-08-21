import React, { Component, h, Fragment } from 'preact';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faHeart } from '@fortawesome/free-solid-svg-icons';
import { BadgeCounter } from '../../cart/CartButton/lib/BadgeCounter';
import { otherwiseLoadJQuery } from '../../../tools/LoadJQuery'

export class FavoritesCounter extends Component {
	constructor(props) {
		super(props);

		this.state = {
			loading: false,
			count: 0,
		}

		this.loadNewCount = this.loadNewCount.bind(this);
		try {
			jQuery(document).on('favorites-updated-single', () => this.loadNewCount());
		} catch {
			otherwiseLoadJQuery();
			jQuery(document).on('favorites-updated-single', () => this.loadNewCount());
		}
	}

	componentDidMount() {
		this.loadNewCount();
	}

	loadNewCount() {
		fetch(`${window['ajax_url']}?action=get_current_user_favorites_count`, {
			method: 'GET'
		})
			.then(res => res.json())
			.then(body => this.setState({
				loading: false,
				count: body.data.count,
			}));
	}

	render() {
		return (
			<Fragment>
				<FontAwesomeIcon icon={faHeart} />
				<small className={'block lg:inline'}>
					Favorieten
				</small>
				{this.state.count > 0 && <BadgeCounter count={this.state.count} />}
			</Fragment>
		);
	}
}
