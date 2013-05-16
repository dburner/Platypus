<?php include('header.php') ?>
<script type="text/javascript" src="<?php echo URL; ?>/ckeditor/ckeditor.js"></script>
<div class="pageWrapper wrapper clearfix">
	<div class="pageContent addCourseContent clearfix">
		<h3>Add Course</h3>
		<div class="separator double"></div>
		<form action="" method="post" class="clearfix">
			<div class="left">
				<div class="titleContainer">
					<!-- Title -->
					<input name="title" type="text" placeholder="Title">
				</div>
				<?php $validator->error('title'); ?>
				<!-- Content -->
				<textarea name="editor" class="ckeditor" id="" cols="30" rows="10"></textarea>
			</div>
			<div class="right">
				<label>Image: </label>
				<!-- Image -->
				<input name="image" type="file">
				<div class="separator dotted"></div>

				<label>Category: </label>
				<!-- Category -->
				<select name="category" style="position:relative;">
					<option value="1x">Javascript</option>
					<option value="2">Python</option>
					<option value="3">C#</option>
					<option value="4">Ruby</option>
				</select>
				<?php $validator->error('category'); ?>
				<div class="separator dotted"></div>

				<label>Tags:</label>
				<!-- Tags[] -->
				<ul id="tagInput">
				</ul>
				<?php $validator->error('tags'); ?>
				<div class="separator dotted"></div>

				<input type="submit" name="save_course" value="Save Course">
				<input type="submit" name="preview" value="Preview">
				
			</div>
		</form>
		<div class="separator double"></div>
	</div>
</div>
<?php include('footer.php') ?>