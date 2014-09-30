<?php

namespace Gourmet\Dashboard\Model\Table;

use Cake\Database\Schema\Table as Schema;
use Cake\Database\Type;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Gourmet\Dashboard\Model\Table\LazyTableTrait;

class EventsTable extends Table {

	use LazyTableTrait;

/**
 * {@inheritdoc}
 */
	public function initialize(array $config) {
		$this->ensureTables(['Gourmet/Dashboard.Event']);
	}

/**
 * {@inheritdoc}
 */
	public function beforeSave(\Cake\Event\Event $event, \Cake\ORM\Entity $entity, \ArrayObject $options) {
		if ($entity->isNew()) {
			$entity->created = date('YmdHis'); //sqlite doesn't support datetime comparisons
		}
		return true;
	}

/**
 * {@inheritdoc}
 */
	public static function defaultConnectionName() {
		return 'gourmet_dashboard';
	}

/**
 * Find ordered by most recent first.
 *
 * @param \Cake\ORM\Query $query
 * @param array $options
 * @return \Cake\ORM\Query
 */
	public function findRecent(Query $query, array $options) {
		return $query->order(['Events.created' => 'DESC'])->limit(10);
	}

/**
 * Find ordered by most recent first.
 *
 * @param \Cake\ORM\Query $query
 * @param array $options
 * @return \Cake\ORM\Query
 */
	public function findUnviewed(Query $query, array $options) {
		return $query->where(['Events.view_cnt' => 0]);
	}

/**
 * Helper to create new event for widget and associated data.
 *
 * @param string $widget Widget's identifier.
 * @param array $data Data attached to event.
 * @return \Cake\Datasource\EntityInterface|bool
 */
	public function push($widget, $data) {
		return $this->save($this->newEntity(compact('widget', 'data')));
	}

/**
 * Find records added since last find operation.
 *
 * @return \Cake\ORM\Query
 */
	public function stream() {
		if (empty($this->_streamStartedAt)) {
			$this->_streamStartedAt = time();
		}

		$date = $this->_streamStartedAt;
		$this->_streamStartedAt = time();
		return $this->find('all')->where(['created >=' => date('YmdHis', $date)]);
	}

/**
 * {@inheritdoc}
 */
	protected function _initializeSchema(Schema $schema) {
		Type::map('gourmet_dashboard', 'Gourmet\Dashboard\Database\Type\JsonType');
		$schema->columnType('data', 'gourmet_dashboard');
		return $schema;
	}

}