<?php
/**
 * Like Behavior
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

/**
 * Like Behavior
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\Likes\Model\Behavior
 */
class LikeBehavior extends ModelBehavior {

/**
 * After find callback. Can be used to modify any results returned by find.
 *
 * @param Model $model Model using this behavior
 * @param mixed $results The results of the find operation
 * @param bool $primary Whether this model is being queried directly (vs. being queried as an association)
 * @return mixed An array value will replace the value of $results - any other value will be ignored.
 * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
 */
	public function afterFind(Model $model, $results, $primary = false) {
		$this->Like = ClassRegistry::init('Likes.Like', true);
		$user = CakeSession::read('Auth.User');
		foreach ($results as $i => $result) {
			if (isset($result[$model->alias]['key'])) {
				$likeCounts = $this->Like->getCountLike($result[$model->alias]['key'], Like::IS_LIKE);
				$unlikeCounts = $this->Like->getCountLike($result[$model->alias]['key'], Like::IS_UNLIKE);
			}
			if (isset($result[$model->alias]['key']) && isset($user['id'])) {
				$results[$i] = Hash::merge($results[$i], $this->Like->getLike($result[$model->alias]['key'], $user['id']));
			}
			$results[$i][$model->alias]['like_counts'] = isset($likeCounts) ? $likeCounts : 0;
			$results[$i][$model->alias]['unlike_counts'] = isset($unlikeCounts) ? $unlikeCounts : 0;
		}

		return $results;
	}
}
