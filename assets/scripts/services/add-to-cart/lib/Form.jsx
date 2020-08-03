import React, { Component } from 'preact';
import PropTypes from 'prop-types';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBox, faPlus, faSpinner, faWineBottle } from '@fortawesome/free-solid-svg-icons'
import { events, fireEvent } from '../../../tools/EventBus';
import ky from 'ky';
import { StyledButton } from './Button';

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

		let res;
		try {
			res = await ky.post(`${window['ajax_url']}?action=add_product_to_cart`, {
				json: data,
				credentials: 'same-origin',
			});
		} catch (e) {
			if (e.name !== 'AbortError') {
				this.setState({loading: false});
				fireEvent(events.PRODUCT.NOT_ADDED_TO_CART, { request: data, exception: e });
				return;
			}
		}

		const body = await res.json();
		fireEvent(events.PRODUCT.ADDED_TO_CART, { request: data, response: body.data });

		this.setState({loading: false});
	}

	render() {
		const { loading } = this.state;
		const { label, amount, product, ...props } = this.props;

		return (
			<form className={this.classList()} onSubmit={this.submitEventListener}>
				<input type="hidden" name="product_id" value={product} />
				<input type="hidden" name="quantity" value={amount} />
				<StyledButton type={'submit'} disabled={loading} {...props}>
					{ label }
					<FontAwesomeIcon icon={loading? faSpinner : faPlus} className={['ml-2'].join(' ')} spin={loading} />
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
