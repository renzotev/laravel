<?php

class CreatePostsTest extends FeatureTestCase
{
	use Illuminate\Foundation\Testing\WithoutMiddleware;

	function test_a_user_create_a_post()
	{
		$title = 'Esta es una pregunta';
		$content = 'Este es el contenido';

		$this->actingAs($user = $this->defaultUser());

		$this->visit(route('posts.create'))
			 ->type($title, 'title')
			 ->type($content, 'content')
			 ->press('Publicar');

		$this->seeInDatabase('posts', [
			'title' => $title,
			'content' => $content,
			'pending' => true,
			'user_id' => $user->id
		]);

		$this->see($title);
	}
}