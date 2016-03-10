/*var mongoose = require('mongoose');
var Account = require('../models/account');

exports.cool = function(req, res) {

	var uri = 'mongodb://fixate:teamrhcp@ds011238.mongolab.com:11238/fixation';
	mongoose.createConnection(uri);

	var newAccount = {
		"name": req.query.fullname,
		"username": req.query.username,
		"password": req.query.password,
		"email": req.query.email,
		"worktime": 30,
		"breaktime": 5,
		"sessions": 3,
		"activities": []
	};
	console.log(newAccount);

	Account.create({
		"name": req.query.fullname,
		"username": req.query.username,
		"password": req.query.password,
		"email": req.query.email,
		"worktime": 30,
		"breaktime": 5,
		"sessions": 3,
		"activities": []
	}, function(err, account) {
					if (err)
						res.send(err);
					res.json({
						success: true,
						account
					});
				});*/






	//var collection = db.get('accounts');
	//collection.insert(newAccount);
		/*Account.findOne({Username:req.body.username},function(err,user){
			if (!accounts) {
   				console.log("Inserting New Account");
				Account.create({
					Name : req.body.fullname,
					Email : req.body.email,	
					Username: req.body.username,
					Pass : req.body.password
				}, function(err, user) {
					if (err)
						res.send(err);
					res.json({
						success: true,
						accounts
					});
				});
  			
			} else {
    				console.log('Username Already Exists');
				res.json({
					success: false,
					message: 'Username already exists',
					accounts
				});	
			}
		});*/
//}