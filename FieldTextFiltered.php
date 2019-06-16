<?php
namespace Pandora3\Widgets\FieldTextFiltered;

use Pandora3\Widgets\FieldText\FieldText;

/**
 * Class FieldTextFiltered
 * @package Pandora3\Widgets\FieldTextFiltered
 */
class FieldTextFiltered extends FieldText {

	/**
	 * {@inheritdoc}
	 */
	protected function getContext(): array {
		$context = parent::getContext();
		$type = $context['type'];
		if ($type === 'number') {
			$context['type'] = 'text';
			$allowedChars = '0-9\-\.';
		} else if ($type === 'int') {
			$context['type'] = 'text';
			$allowedChars = '0-9\-';
		} else {
			$allowedChars = $context['allowedChars'] ?? null;
		}
		return array_replace( $context, [
			'allowedChars' => $allowedChars
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function beforeRender(array $context): array {
		if ($context['allowedChars'] ?? null) {
			$attribs = $context['attribs'] ?? '';
			$context['attribs'] = $attribs.' onkeypress="filterKey(event, \''.$context['allowedChars'].'\')"';
		}
		return $context;
	}
	
}