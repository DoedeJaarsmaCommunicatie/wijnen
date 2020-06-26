import React, { Component, h } from 'preact';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSearch } from '@fortawesome/free-solid-svg-icons';
import { AutoFill } from './AutoFill';
import styled from 'styled-components';

const SearchApp = styled.div`
  display: flex;
  width: 100%;
  position: relative;
`;

export class App extends Component {
	constructor() {
		super();

		this.abortControllers = [];

		this.state = {
			loading: false,
			show_results: false,
			results: [],
		};

		this.handleFocusEvent = this.handleFocusEvent.bind(this);
		this.hideSearchFill = this.hideSearchFill.bind(this);
		this.handleSearchInput = this.handleSearchInput.bind(this);
	}

	handleFocusEvent(e) {
		this.setState({
			show_results: true,
		});
	}

	hideSearchFill() {
		this.setState({
			show_results: false,
		});
	}

	async handleSearchInput(e) {
		this.abortControllers.forEach(abortController => abortController.abort());
		const abortController = new AbortController();
		this.abortControllers.push(abortController);


		const value = e.target.value;
		if ('' === value || null === value || !value) {
			return this.hideSearchFill();
		}
		let res;

		try {
			res = await (await fetch(window['ajax_url'] + `?action=search_results&s=${value}`, {
				signal: abortController.signal,
			})).json();
		} catch { return; }

		this.setState({
			show_results: true,
			results: res.data.posts
		});
	}

	render() {
		return (
			<SearchApp className={'search-app'}>
				<input
					placeholder={'Zoek een product...'}
					id={'s'}
					name={'s'}
					type={'search'}
					autocomplete={'off'}
					className={'search-form-input'}
					onFocus={this.handleFocusEvent}
					onblur={this.hideSearchFill}
					onInput={this.handleSearchInput} />

				<button type={'submit'} class={'search-button'}><FontAwesomeIcon icon={faSearch} /></button>

				{this.state.show_results && <AutoFill results={this.state.results} className={'search-auto-fill'} />}
			</SearchApp>
		);
	}
}
