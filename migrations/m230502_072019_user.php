<?php

use yii\db\Migration;
use yii\helpers\BaseConsole;
use yii\helpers\Console;

/**
 * Class m230502_072019_user
 */
class m230502_072019_user extends Migration {
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp(): void {


        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->null(),
            'email' => $this->string(255)->notNull()->unique(),
            'surname' => $this->string(255)->notNull(),
            'name' => $this->string(255)->notNull(),
            'image' => $this->string(255)->null(),
            'language' => $this->string(5)->notNull(),
            'password' => $this->string(255)->notNull(),
            'last_activity_time' => $this->bigInteger(16)->null(),
            'last_update_time' => $this->bigInteger(16)->null(),
            'create_time' => $this->bigInteger(16)->notNull(),
        ]);

        $this->addForeignKey('fk_user_user_id', 'user', 'user_id', 'user', 'id', 'NO ACTION', 'NO ACTION');

        $email = Console::prompt('Enter admin email: ', [
            'required' => true,
            'validator' => function ($input, &$error) {
                if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                    $error = 'Email is not valid';
                    return false;
                }
                return true;
            }
        ]);

        $surname = Console::prompt('Enter admin surname: ', [
            'required' => true,
            'validator' => function ($input, &$error) {
                if (strlen($input) < 2) {
                    $error = 'Surname must be at least 2 characters';
                    return false;
                }
                return true;
            }
        ]);

        $name = Console::prompt('Enter admin name: ', [
            'required' => true,
            'validator' => function ($input, &$error) {
                if (strlen($input) < 2) {
                    $error = 'Name must be at least 2 characters';
                    return false;
                }
                return true;
            }
        ]);

        $password = Console::prompt('Enter admin password: ', [
            'required' => true,
            'validator' => function ($input, &$error) {
                if (strlen($input) < 8) {
                    $error = 'Password must be at least 6 characters';
                    return false;
                }
                return true;
            },
        ]);

        $this->insert('user', [
            'user_id' => null,
            'email' => $email,
            'surname' => $surname,
            'name' => $name,
            'image' => null,
            'language' => 'ru',
            'password' => Yii::$app->security->generatePasswordHash($password),
            'last_activity_time' => null,
            'last_update_time' => null,
            'create_time' => time(),
        ]);

        Console::output("\n");
        Console::output(Console::ansiFormat("Administrator user successfully created with the specified credentials", [BaseConsole::FG_GREEN]));
        Console::output("\n");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): bool {
        $this->dropTable('user');
        return true;
    }
}
