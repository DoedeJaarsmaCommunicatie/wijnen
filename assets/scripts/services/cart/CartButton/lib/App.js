import React, { Component, h, Fragment } from 'preact';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons';
import { events, listenEvent } from '../../../../tools/EventBus';
import { BadgeCounter } from './BadgeCounter';
import PropTypes from 'prop-types';

export class CartButton extends Component {
	constructor(props) {
		super(props);

		this.state = {
			count: this.props.initialCount?? 0
		}

		this.updateCartAmount = this.updateCartAmount.bind(this);
		listenEvent(events.PRODUCT.ADDED_TO_CART, this.updateCartAmount);
	}

	updateCartAmount({ detail }) {
		this.setState({
			count: detail.response.cart_count?? 0
		});
	}

	render() {
		return (
			<Fragment>
				<FontAwesomeIcon icon={faShoppingCart} />
				<small className={'block lg:inline'}>
					Wijnmandje
				</small>
				{this.state.count > 0 && <BadgeCounter count={this.state.count} />}
			</Fragment>
		);
	}
}

CartButton.propTypes = {
	initialCount: PropTypes.number,
}
