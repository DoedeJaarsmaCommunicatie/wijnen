import React, { Component, h } from 'preact';
import PropTypes from 'prop-types';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBox, faWineBottle, faSpinner } from '@fortawesome/free-solid-svg-icons'
import styled from 'styled-components';
import { events, fireEvent } from '../../../tools/EventBus';
import ky from 'ky';

const StyledButton = styled.button`
	background: #c96464;
	color: #fff;
	padding: .5rem;
	border-radius: 4px;
	width: 100%;
`;

export class Form extends Component {
	constructor() {
		super();

		this.classList = this.classList.bind(this);
		this.buttonIcon = this.buttonIcon.bind(this);
		this.submitEventListener = this.submitEventListener.bind(this);
		this.state = {
			loading: false,
		}
	}

	classList() {
		const classes = this.props.classes?? [];

		return classes.join(' ');
	}

	buttonIcon() {
		if (this.state.loading) {
			 return faSpinner;
		}
		return this.props.icon === 'box'? faBox : faWineBottle;
	}

	async submitEventListener(e) {
		e.preventDefault();
		this.setState({loading: true});

		const data = {
			product_id: this.props.product,
			qty: this.props.amount
		};

		const res = await ky.post(`${window['ajax_url']}?action=add_product_to_cart`, {
			json: data,
			credentials: 'same-origin',
		});

		const body = await res.json();
		fireEvent(events.PRODUCT.ADDED_TO_CART, { request: data, response: body.data });

		this.setState({loading: false});
	}

	render() {
		return (
			<form className={this.classList()} onSubmit={this.submitEventListener}>
				<input type="hidden" name="product_id" value={this.props.product} />
				<input type="hidden" name="quantity" value={this.props.amount} />
				<StyledButton type={'submit'}>
					<FontAwesomeIcon icon={this.buttonIcon()} className={[
						this.props.label? 'mr-2' : '',
					].join(' ')} spin={ this.state.loading } />
					{ this.props.label }
				</StyledButton>
			</form>
		)
	}
}

Form.propTypes = {
	amount: PropTypes.number.isRequired,
	product: PropTypes.number.isRequired,

	label: PropTypes.string,
	icon: PropTypes.oneOf(['box', 'wine-bottle']),
	classes: PropTypes.array,
}
