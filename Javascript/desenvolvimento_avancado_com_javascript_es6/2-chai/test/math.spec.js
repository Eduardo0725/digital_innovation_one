const assert = require('assert');
const Math = require('../src/math.js');
const expect = require('chai').expect;

let value = 0;

describe('Math class', function() {
	//hooks
	beforeEach(function() {
		value = 0;
	});

    it('Sum two numbers', function(done){
	const math = new Math();
	this.timeout(3000);

	value = 5;
	
	math.sum(value, 5, (value) => {
		expect(value).to.equal(10);
		done();
	});
	});
	
	it('Multiply two numbers', function() {
		const math = new Math();
		const obj = {
			name: 'Celso Henrique'
		}

		const obj2 = {
			name: 'Celso Henrique'
		}

		expect(obj).to.deep.equal(obj2);
	});
})
