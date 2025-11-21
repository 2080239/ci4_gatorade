<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (!function_exists('roleId')) {
	/**
	 * Lookup role id by slug with simple static cache.
	 * Returns null if not found.
	 */
	function roleId(string $slug): ?int
	{
		static $cache = [];
		if (isset($cache[$slug])) {
			return $cache[$slug];
		}
		$modelClass = '\\App\\Models\\RoleModel';
		if (!class_exists($modelClass)) {
			return null;
		}
		$model = new $modelClass();
		$row = $model->where('slug', $slug)->first();
		if (!$row) {
			return null;
		}
		$cache[$slug] = (int) $row['id'];
		return $cache[$slug];
	}
}

if (!function_exists('isRole')) {
	/**
	 * Quick check if a user record matches a role slug.
	 */
	function isRole(array $user, string $slug): bool
	{
		$id = roleId($slug);
		return $id !== null && (int)($user['role_id'] ?? 0) === $id;
	}
}

if (!function_exists('roleSlug')) {
	/**
	 * Reverse lookup: given a numeric role id return slug.
	 */
	function roleSlug(int $id): ?string
	{
		static $slugCache = [];
		if (isset($slugCache[$id])) return $slugCache[$id];
		$modelClass = '\\App\\Models\\RoleModel';
		if (!class_exists($modelClass)) return null;
		$model = new $modelClass();
		$row = $model->where('id',$id)->first();
		if (!$row) return null;
		return $slugCache[$id] = $row['slug'];
	}
}

if (!function_exists('userHasRole')) {
	/**
	 * More expressive helper to check a user array vs role slug.
	 */
	function userHasRole(array $user, string $slug): bool
	{
		return isRole($user, $slug);
	}
}
