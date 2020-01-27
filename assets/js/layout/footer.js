import React from 'react';
import ReactDOM from 'react-dom';

const root = document.getElementsByTagName('footer')[0];
const today = new Date().getFullYear();
const footer = (
	<div className="footer-content">&copy; All rights reserved, <span className="font-weight-bold">Techpike s.r.o. {today}</span></div>

);
ReactDOM.render(footer,root);

