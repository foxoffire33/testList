<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Login form
 */
class LoginForm extends Model
{
    const SCENARIO_BACKEND = 'backend';
    const SCENARIO_FRONTEND = 'frontend';
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function scenarios()
    {
        return ArrayHelper::merge([
            self::SCENARIO_BACKEND => ['username', 'password', 'rememberMe', 'isAdmin'],
            self::SCENARIO_FRONTEND => ['username', 'password', 'rememberMe']
        ], parent::scenarios());
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            if (!empty(($user = User::findOne(['username' => $this->username])))) {
                if ($this->scenario == self::SCENARIO_BACKEND && $user->role == 'admin') {
                    $this->_user = $user;
                } elseif ($this->scenario !== self::SCENARIO_BACKEND) {
                    $this->_user = $user;
                }
            }
        }
        return $this->_user;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
}
