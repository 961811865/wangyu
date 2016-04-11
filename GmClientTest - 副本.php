<?php 

namespace tests\codeception\unit\gmtest;

use Yii;
use yii\codeception\TestCase;
use app\models\GmClient;
use app\models\GearmanClient;
use \Codeception\Specify;

class GmClientTest extends TestCase
{
	use Specify;

	protected  function _before()
	{
		$this->model = new GmClient;
	}

	protected  function _after()
	{
		unset($this->model);
	}

	/**
	 * test1
     * 发送聊天公告(非维护公告) 主要是聊天公告和定时聊天公告
     * 异步模式
     * @param  array $msg    聊天公告['text' => '要发送的公告内容' , 'id'=>公告id ,type => 'sync(即时)/time(定时)']
     * @param  array  $server 服务器ip和端口号 二维数组：[[tcp://127.0.0.1:1234]]
     * @return boolean
     */
	public function testSendAnnAsync()
	{
		// $this->specify('环节1:测试参数', function(){
		// 	$annDetail1 = [];
		// 	$server1 	= [];
		// 	$res1    	= $this->model->sendAnnAsync($annDetail1,$server1);
		// 	$this->assertFalse($res1);
		// });


		// $this->specify('环节2:测试参数', function(){
		// 	$annDetail2 = ['text' => 'This is a test!'];
		// 	$server2 	= [];
		// 	$res2    	= $this->model->sendAnnAsync($annDetail2,$server2);
		// 	$this->assertFalse($res2);
		// });
		

		// $this->specify('环节3:测试参数', function(){
		// 	$annDetail3 = ['text' => 'This is a test!','id' => 10];
		// 	$server3 	= [];
		// 	$res3    	= $this->model->sendAnnAsync($annDetail3,$server3);
		// 	$this->assertFalse($res3);
		// });
		

		// $this->specify('环节4:测试参数', function(){
		// 	$annDetail4 = ['text' => 'This is a test!','id' => 10,'type' => 'test'];
		// 	$server4 	= [];
		// 	$res4    	= $this->model->sendAnnAsync($annDetail4,$server4);
		// 	$this->assertFalse($res4);
		// });
		

		// $this->specify('环节5:测试参数', function(){
		// 	$annDetail5 = ['text' => 'This is a test!','id' => 10,'type' => 'sync'];
		// 	$server5 	= [];
		// 	$res5    	= $this->model->sendAnnAsync($annDetail5,$server5);
		// 	$this->assertFalse($res5);
		// });
		

		// $this->specify('环节6:测试参数', function(){
		// 	// $array参数为二维数组，传一维也可以
		// 	$annDetail6 = ['text' => 'This is a test!','id' => 10,'type' => 'sync'];
		// 	$server6    = [['127.0.0.1']];
		// 	$res6       = $this->model->sendAnnAsync($annDetail6,$server6);
		// 	// 返回true，执行完毕
		// 	$this->assertTrue($res6);
		// });

		
		$this->specify("参数验证", function(){
			$annDetail = ['text' => 'This is a test!','id' => 10,'type' => 'time'];
			$server    = [['127.0.0.1']];
			$this->assertNotEmpty($annDetail);
			$this->assertInternalType('array',$annDetail);
			$this->assertArrayHasKey('text',$annDetail);
			$this->assertArrayHasKey('id',$annDetail);
			$this->assertArrayHasKey('type',$annDetail);
			$this->assertEquals('time',$annDetail['type']);
			$this->assertNotEmpty($server);

			$res = $this->model->sendAnnAsync($annDetail,$server);
			$this->assertTrue($res);
		});
		
		
	}


	/**
	 * test2
     * 发送聊天公告(非维护公告) 主要是聊天公告和定时聊天公告
     * 同步模式
     * @param  string $msg    聊天公告内容
     * @param  array  $server 服务器ip和端口号 二维数组：[['id' ,'ip'=>'127.0.0.1' , 'port'=>12345]]
     * @return boolean
     */
	public function testsendAnnNow()
	{
		$this->specify("参数验证", function(){
			$annDetail = ['text' => 'This is a test!','id' => 10,'type' => 'time'];
			$server    = [['127.0.0.1']];
			$this->assertNotEmpty($annDetail);
			$this->assertInternalType('array',$annDetail);
			$this->assertArrayHasKey('text',$annDetail);
			$this->assertArrayHasKey('id',$annDetail);
			$this->assertArrayHasKey('type',$annDetail);
			$this->assertEquals('time',$annDetail['type']);
			$this->assertNotEmpty($server);

			$res = $this->model->sendAnnAsync($annDetail,$server);
			$this->assertTrue($res);
		});
	}

	/**
	 * test3
	 * 玩家信息接口
	 */
	public function testFindUserNow()
	{
		$userInfo = ['id' => 1 , 'name' => 'testUser'];
		$server   = ['id' => 10 , 'ip' => '127.0.0.1' , 'port' => 80];
		$this->assertNotEmpty($userInfo);
		$this->assertArrayHasKey('id',$userInfo);
		$this->assertNotEmpty($server['id']);
		$this->assertNotEmpty($server['ip']);
		$this->assertNotEmpty($server['port']);
	}

	/**
	 * test4
     * 查询角色订单
     * @param  string $roleId  玩家角色id
     * @param  string $orderId 玩家订单号
     * @param array $server 玩家角色所在服务器信息
     * id(表中的服务器id) ip：服务器IP port：服务器socket端口
     * @return [type]          [description]
     */
    public function testGetUserOrder()
    {
    	$roleId  = 1;
    	$orderId = 1;
    	$server  = ['id' => 10 , 'ip' => '127.0.0.1' , 'port' => 80];
    	$this->assertNotFalse($roleId);
    	$this->assertNotFalse($orderId);
    	$this->assertNotEmpty($server);
    	$this->assertNotEmpty($server['id']);
    	$this->assertNotEmpty($server['ip']);
    	$this->assertNotEmpty($server['port']);
    }

}