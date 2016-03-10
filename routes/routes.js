var Account = require('../models/account');

function getAccounts(res){
	Account.find(function(err, accounts) {
		if (err)
			res.send(err)

		res.json(accounts); // return all todos in JSON format
	});
};

module.exports = function(app) {
	app.get('/accounts.html', function(req, res) {
		//res.render('index', getAccounts(res));
		getAccounts(res);
	});

	/*app.post('/accounts.html', function(req, res) {
		console.log("inside post method!!!!");
		Account.findOne({Username:req.body.username},function(err,user){
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
		});


	});*/
}