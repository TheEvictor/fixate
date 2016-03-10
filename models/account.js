var mongoose = require('mongoose');

var Schema = mongoose.Schema;

var accountSchema = new Schema( {
	Name: { type : String, default:''},
	Username: { type : String, default:''},
	Pass: { type: String, default:''},
	Email: { type: String, default:''},
	Worktime: { type: Number, default:'30'},
	Breaktime: { type: Number, default:'5'},
	Sessions: { type: Number, default:'3'},
	Activities: [{ body: String }]
	}
);

module.exports = mongoose.model('Account', accountSchema);