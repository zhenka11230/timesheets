import java.io.*;
public class Calculator {

    Calculator(){
        result = 0;
        operator = " ";
        operand = 0;
        calculation_strategies = new CalculationStrategy[1000];
        initStrategies();
    }

    void initStrategies(){
         calculation_strategies[("+".hashCode())] = new CalculationStrategy(this) {
             void performOperation() {
                 context.setResult(context.getResult() + context.getOperand());
             }
         };

        calculation_strategies[("-".hashCode())] = new CalculationStrategy(this) {
            void performOperation() {
                context.setResult(context.getResult() - context.getOperand());
            }
        };

        calculation_strategies[("*".hashCode())] = new CalculationStrategy(this) {
            void performOperation() {
                context.setResult(context.getResult() * context.getOperand());
            }
        };

        calculation_strategies[("/".hashCode())] = new CalculationStrategy(this) {
            void performOperation() {
                context.setResult(context.getResult() / context.getOperand());
            }
        };

        calculation_strategies[("^".hashCode())] = new CalculationStrategy(this) {
            void performOperation() {
                context.setResult((int)(Math.pow((double)context.getResult(), (double)context.getOperand())));
            }
        };
    }
    
    void performOperation(){
         this.calculation_strategies[(operator.hashCode())].performOperation();
    }

    public static void main(String args[]){
        Calculator calculator = new Calculator();
        String input= "";
        String[] arguments = {"start"};
        BufferedReader cin = new BufferedReader(new InputStreamReader(System.in));

        while (true){
        System.out.println("Enter Operator followed by Operand: ");
        try{
            input = cin.readLine();
        } catch(Exception e) {}

        if(input.equals("end")) break;

        arguments = input.split(" ");
        
        calculator.setOperator(arguments[0]);
        calculator.setOperand(Integer.parseInt(arguments[1]));
        calculator.performOperation();
        
        System.out.println("Total: " + calculator.getResult());
        System.out.println();
        }
    
    }


    public Integer getResult() {
        return result;
    }

    public void setResult(Integer result) {
        this.result = result;
    }

    public Integer getOperand() {
        return operand;
    }

    public void setOperand(Integer operand) {
        this.operand = operand;
    }

    public String getOperator() {
        return operator;
    }

    public void setOperator(String operator) {
        this.operator = operator;
    }

    protected Integer result;
    protected Integer operand;
    private String operator;


    
    CalculationStrategy[] calculation_strategies;
    
}

abstract class CalculationStrategy{

    Calculator context;

    CalculationStrategy(Calculator context)  {
           this.context = context;
    }

    abstract void performOperation();

}

