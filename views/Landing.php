<?php include('header.php') ?>
<div id="blackScreen" class="<?php if (!empty($_POST)) echo 'active'; ?>">
	<div id="loginCenter">
		<div class="options">
			<a class="<?php if (empty($_POST)) echo 'active'; else if (isset($_POST['login'])) echo 'active'; ?> login">Login Area</a>
			<a class="<?php if (isset($_POST['register'])) echo 'active'; ?> register">Create Account</a>
		</div>
		<hr />
		<div class="loginContainer <?php if (empty($_POST)) echo 'active'; else if (isset($_POST['login'])) echo 'active'; ?> container">
			<form action="<?php echo URL; ?>" method="POST">
				<input type="text" name="email" placeholder="Email" value="<?php echo $_POST['email'] ?>" class="<?php if(is_error($errors, 'login', 'email')) echo 'red'; ?>" />
				<?php if(is_error($errors, 'login', 'email')): ?>
					<p class="error">
						<?php echo $errors['login']['email']; ?>
					</p>
				<?php endif; ?>
				<input type="password" name="password" placeholder="Password" class="<?php if(is_error($errors, 'login', 'password')) echo 'red'; ?>" />
				<?php if(is_error($errors, 'login', 'password')): ?>
					<p class="error">
						<?php echo $errors['login']['password']; ?>
					</p>
				<?php endif; ?>
				<input type="hidden" />
				<hr />
				<a class="forgot">Forgot my password</a>
				<input type="submit" name="login" value="Login" />
			</form>
		</div>

		<div class="registerContainer <?php if (isset($_POST['register'])) echo 'active'; ?> container">
			<form action="<?php echo URL; ?>" method="POST">
				<!-- Email -->
				<input type="text" name="email" placeholder="Email" class="<?php if(is_error($errors, 'register', 'email')) echo "red"; ?>" value="<?php echo $_POST['email'] ?>"/>
				<?php if(is_error($errors, 'register', 'email')): ?>
					<p class="error">
						<?php echo $errors['register']['email']; ?>
					</p>
				<?php endif; ?>
				
				<!-- Password -->
				<input type="password" name="password" placeholder="Password" class="<?php if(is_error($errors, 'register', 'password')) echo "red"; ?>" value="<?php echo $_POST['password'] ?>"/>
				<?php if(is_error($errors, 'register', 'password')): ?>
					<p class="error">
						<?php echo $errors['register']['password']; ?>
					</p>
				<?php endif; ?>
				
				<!-- Username -->
				<input type="text" name="username" placeholder="Username" class="<?php if(is_error($errors, 'register', 'username')) echo "red"; ?>" value="<?php echo $_POST['username'] ?>"/>
				<?php if(is_error($errors, 'register', 'username')): ?>
					<p class="error">
						<?php echo $errors['register']['username']; ?>
					</p>
				<?php endif; ?>
				
				<!-- Name -->
				<input type="text" name="name" placeholder="Name" class="<?php if(is_error($errors, 'register', 'name')) echo "red"; ?>" value="<?php echo $_POST['name'] ?>"/>
				<?php if(is_error($errors, 'register', 'name')): ?>
					<p class="error">
						<?php echo $errors['register']['name']; ?>
					</p>
				<?php endif; ?>
				<p style="text-align:right;">
					<em style="color:#777;">* All fields are required</em>
				</p>
				<hr />
				<input type="submit" name="register" value="Create Account" />
			</form>
		</div>

		<div class="forgotContainer <?php if (isset($_POST['recover'])) echo 'active'; ?> container">
			<form action="<?php echo URL; ?>" method="POST">
				<input type="text" name="email" placeholder="Email" />
				<?php if(is_error($errors, 'recover', 'email')): ?>
					<p class="error">
						<?php echo $errors['recover']['email']; ?>
					</p>
				<?php endif; ?>
				<?php if (isset($success['recover']['email'])): ?>
					<p class="success">
						<?php echo $success['recover']['email']; ?>
					</p>
				<?php endif; ?>
				<hr />
				<input type="submit" name="recover" value="Recover password" />
			</form>
		</div>
	</div>
</div>
<div class="wrapper landingWrapper">
	<div class="landingContent">
		<div class="tabSwitcher">
			<span class="sageata pos0"></span>
			<div class="tabNav">
				<a class="tabs active" order="0">Features</a>
				<a class="tabs" order="1">Highlights</a>
				<a class="tabs" order="2">Samples</a>
			</div>
			<div class="tabContainer">
				<div class="containers active" order="0">
					<img src="http://i.istockimg.com/generic_image_view/193189/193189" width="100%" alt="" />
					<hr />
					<h3>First tab</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit dignissimos.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae odio reiciendis aliquid minus laborum consectetur beatae rerum assumenda blanditiis est quae dicta omnis illum doloribus et fuga molestiae? Officiis consequatur.</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam tenetur reiciendis facere illum non quibusdam nobis corporis dolores ipsum neque at similique iste culpa. Aut ad laborum non debitis temporibus totam nulla aliquam. Amet culpa eum debitis omnis fugiat id libero quod eos vel doloribus. Animi fugit non libero eum.</p>
					<blockquote>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque impedit magni ratione optio illo repellendus error ad provident esse fugiat cumque quae inventore explicabo eos aspernatur quaerat asperiores porro sed.</blockquote>
					<ul>
						<li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis explicabo culpa minus aliquid consequatur nulla.</li>
						<li>Ad natus expedita fugit nihil. Reprehenderit labore asperiores velit odio accusantium exercitationem ipsam optio similique.</li>
						<li>Veritatis aut architecto ducimus totam quis quisquam veniam expedita amet corrupti assumenda explicabo facilis odio.</li>
						<li>Blanditiis quia cupiditate laborum earum iste iusto rem praesentium aut id at dolore itaque suscipit.</li>
						<li>Modi odit quisquam nisi eligendi harum a repellendus fugiat iste dolorem voluptates! Fuga aliquid itaque.</li>
						<li>Voluptatem eligendi cumque amet perferendis corporis deleniti similique tenetur illo nisi aut doloribus molestias quisquam.</li>
					</ul>
				</div>
				<div class="containers" order="1">
					<h3>Second tab</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt eligendi earum nemo amet laboriosam modi repellat placeat! Eveniet ducimus a.</p>
					<canvas id="Chart1" width="1200" height="400"></canvas>
				</div>
				<div class="containers" order="2">
					<h3>Last damn tab</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit pariatur veritatis perferendis eum magni officiis!</p>
					<canvas id="Chart2" width="600" height="400"></canvas>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia eius culpa repellat beatae inventore sed nulla sapiente porro asperiores natus voluptatibus doloribus. Modi labore voluptas nemo ad inventore architecto enim eius atque neque adipisci blanditiis minus autem voluptatum non repudiandae magni cum dolore minima expedita debitis est aut veritatis nostrum dignissimos officia amet consectetur vel libero alias dolores aliquid quae porro necessitatibus? Labore debitis esse eum saepe delectus officiis illo expedita dignissimos vel repellendus eligendi doloribus temporibus tenetur earum dolorum enim quo odio accusantium atque id fugiat est voluptatem necessitatibus reprehenderit nobis quam unde sed perspiciatis non accusamus quae ipsa!</p>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php include('footer.php') ?>